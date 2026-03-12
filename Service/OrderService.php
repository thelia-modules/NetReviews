<?php

namespace NetReviews\Service;

use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\NetReviews;
use NetReviews\Object\NetReviewsOrder;
use NetReviews\Object\NetReviewsProduct;
use Propel\Runtime\Connection\ConnectionWrapper;
use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thelia\Core\Event\Image\ImageEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Model\ConfigQuery;

class OrderService
{
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var  Request */
    protected $request;

    public function __construct(EventDispatcherInterface $eventDispatcher, Request $request)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->request = $request;
    }

    public function sendOrder($orderId)
    {
        $apiKey = NetReviews::getConfigValue('api_key');
        $idWebSite = NetReviews::getConfigValue('id_website');

        $netreviewsOrder = $this->getNetreviewsOrder($orderId);
        $products = [];

        /** @var NetReviewsProduct $product */
        foreach ($netreviewsOrder->getProducts() as $product) {
            $products[] = [
                'id_product' => $product->getId(),
                'name_product' => $product->getName(),
                'url_product' => $product->getUrl(),
                'url_product_image' => $product->getImageUrl(),
                'GTIN_EAN' => $product->getGtinEan()
            ];
        }

        $message = [
            'order_ref' => $netreviewsOrder->getRef(),
            'email' => $netreviewsOrder->getEmail(),
            'order_date' => $netreviewsOrder->getDate(),
            'firstname' => $netreviewsOrder->getFirstname(),
            'lastname' => $netreviewsOrder->getLastname(),
            'delay' => $netreviewsOrder->getDelay(),
            'products' => $products
        ];

        $apiUrl = "https://api.skeepers.io/v1/orders";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Api-Key: ' . $apiKey,
            'X-Id-Website: ' . $idWebSite
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $decodedResponse = json_decode($response);

        if ($httpCode >= 200 && $httpCode < 300) {
            $netreviewsOrderQueue = NetreviewsOrderQueueQuery::create()
                ->filterByOrderId($orderId)
                ->findOneOrCreate();
            $netreviewsOrderQueue->setTreatedAt(new \DateTime())
                ->setStatus('1')
                ->save();
            
            if (!isset($decodedResponse->return)) {
                $decodedResponse = (object)['return' => 1];
            }
        } else {
             if (!isset($decodedResponse->return)) {
                $decodedResponse = (object)[
                    'return' => 0,
                    'debug' => $response ?: "HTTP Error $httpCode"
                ];
            }
        }

        return $decodedResponse;
    }

    public function getNetreviewsOrder($orderId)
    {
        /** @var ConnectionWrapper $con */
        $con = Propel::getConnection();
        $statusToExport = NetReviews::getConfigValue('status_to_export', '3,4');
        $delay = NetReviews::getConfigValue('email_delay', '3');

        $orderProductSql = "SELECT o.ref, o.created_at, cu.firstname, cu.lastname, cu.email, op.product_ref, op.title, op.ean_code, ru.url, pi.file
                            FROM order_product op 
                            LEFT JOIN `order` o ON (op.order_id = o.id)
                            LEFT JOIN `customer` cu ON (o.customer_id = cu.id)
                            LEFT JOIN `product` p ON (p.ref = op.product_ref)
                            LEFT JOIN `rewriting_url` ru ON (p.id = ru.view_id AND ru.view = 'product' AND ru.redirected IS NULL)
                            LEFT JOIN `product_image` pi ON (p.id = pi.product_id AND pi.position = 1)
                            WHERE o.id = $orderId
                            AND o.status_id IN ($statusToExport)";

        $stmt = $con->prepare($orderProductSql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (empty($results)) {
            throw new \Exception("The order was not ready to be exported");
        }

        $netReviewsOrder = new NetReviewsOrder();

        $netReviewsOrder->setRef($results[0]['ref'])
            ->setDate($results[0]['created_at'])
            ->setFirstname($results[0]['firstname'])
            ->setLastname($results[0]['lastname'])
            ->setEmail($results[0]['email'])
            ->setDelay($delay);

        $baseUrl = ConfigQuery::read('url_site');

        $products = [];

        foreach ($results as $orderProduct) {
            $product = new NetReviewsProduct();
            $product
                ->setId($orderProduct['product_ref'])
                ->setName($orderProduct['title']);

            if ($orderProduct['file'] !== null) {
                $imageEvent = $this->createProductImageEvent($orderProduct['file']);
                $this->eventDispatcher->dispatch(TheliaEvents::IMAGE_PROCESS, $imageEvent);
                $imagePath = $imageEvent->getFileUrl();
                $product->setImageUrl($imagePath);
            }

            if ($orderProduct['url'] !== null) {
                $product->setUrl($baseUrl . "/" . $orderProduct['url']);
            }

            if($orderProduct['ean_code']){
                $product->setGtinEan($orderProduct['ean_code']);
            }

            $products[] = $product;
        }

        $netReviewsOrder->setProducts($products);

        return $netReviewsOrder;
    }

    /**
     * @param string $imageFile
     * @return ImageEvent
     */
    protected function createProductImageEvent($imageFile)
    {
        $imageEvent = new ImageEvent($this->request);
        $baseSourceFilePath = ConfigQuery::read('images_library_path');
        if ($baseSourceFilePath === null) {
            $baseSourceFilePath = THELIA_LOCAL_DIR . 'media' . DS . 'images';
        } else {
            $baseSourceFilePath = THELIA_ROOT . $baseSourceFilePath;
        }
        // Put source image file path
        $sourceFilePath = sprintf(
            '%s/%s/%s',
            $baseSourceFilePath,
            'product',
            $imageFile
        );
        $imageEvent->setSourceFilepath($sourceFilePath);
        $imageEvent->setCacheSubdirectory('product');
        return $imageEvent;
    }
}