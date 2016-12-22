<?php

namespace NetReviews\Service;

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

    public function sendOrderToNetReviews($orderId)
    {
        $idWebSite = NetReviews::getConfigValue('id_website');
        $secret = NetReviews::getConfigValue('secret_token');

        $netreviewsOrder = $this->getNetreviewsOrder($orderId);
        $products = [];

        /** @var NetReviewsProduct $product */
        foreach ($netreviewsOrder->getProducts() as $product) {
            $products[] = [
                'id_product' => $product->getId(),
                'name_product' => $product->getName(),
                'url_product' => $product->getUrl(),
                'url_product_image' => $product->getImageUrl()
            ];
        }

        $message = [
            'order_ref' => $netreviewsOrder->getRef(),
            'email' => $netreviewsOrder->getEmail(),
            'order_date' => $netreviewsOrder->getDate(),
            'firstname' => $netreviewsOrder->getFirstname(),
            'lastname' => $netreviewsOrder->getLastname(),
            'delay' => $netreviewsOrder->getDelay(),
        ];

        $message['PRODUCTS'] = $products;


    }

    public function getNetreviewsOrder($orderId)
    {
        /** @var ConnectionWrapper $con */
        $con = Propel::getConnection();

        $orderProductSql = "SELECT o.ref, o.created_at, cu.firstname, cu.lastname, cu.email, op.product_ref, op.title, ru.url, pi.file
                            FROM order_product op 
                            LEFT JOIN `order` o ON (op.order_id = o.id)
                            LEFT JOIN `customer` cu ON (o.customer_id = cu.id)
                            LEFT JOIN `product` p ON (p.ref = op.product_ref)
                            LEFT JOIN `rewriting_url` ru ON (p.id = ru.view_id)
                            LEFT JOIN `product_image` pi ON (p.id = pi.product_id)
                            WHERE o.id = $orderId
                            AND ru.view = 'product'
                            AND ru.redirected IS NULL
                            AND pi.position = 1
                            ";

        $stmt = $con->prepare($orderProductSql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $netReviewsOrder = new NetReviewsOrder();

        $netReviewsOrder->setRef($results[0]['ref'])
            ->setDate($results[0]['created_at'])
            ->setFirstname($results[0]['firstname'])
            ->setLastname($results[0]['lastname'])
            ->setEmail($results[0]['email'])
            ->setDelay(0);

        $baseUrl = ConfigQuery::read('url_site');

        $products = [];

        foreach ($results as $orderProduct) {
            $imageEvent = $this->createProductImageEvent($orderProduct['file']);
            $this->eventDispatcher->dispatch(TheliaEvents::IMAGE_PROCESS, $imageEvent);
            $imagePath = $imageEvent->getFileUrl();

            $product = new NetReviewsProduct();
            $product->setId($orderProduct['product_ref'])
                ->setName($orderProduct['title'])
                ->setUrl($baseUrl."/".$orderProduct['url'])
                ->setImageUrl($imagePath);

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