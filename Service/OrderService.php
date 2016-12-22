<?php

namespace NetReviews\Service;

use NetReviews\NetReviews;
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


    }

    public function getOrderInfos($orderId)
    {
        $idWebSite = NetReviews::getConfigValue('id_website');
        $secret = NetReviews::getConfigValue('secret_token');

        /** @var ConnectionWrapper $con */
        $con = Propel::getConnection();

        $orderProductSql = "SELECT o.ref, cu.firstname, cu.lastname, cu.email, op.product_ref, op.title, ru.url, pi.file
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

        $orderRef = $results[0]['ref'];
        $token = sha1($idWebSite.$secret.$orderRef);
        $firstname = $results[0]['firstname'];
        $lastname = $results[0]['lastname'];
        $email = $results[0]['email'];

        $baseUrl = ConfigQuery::read('url_site');

        foreach ($results as $orderProduct) {
            $imageEvent = $this->createProductImageEvent($orderProduct['file']);
            $this->eventDispatcher->dispatch(TheliaEvents::IMAGE_PROCESS, $imageEvent);
            $imagePath = $imageEvent->getFileUrl();

            $products[] = [
                'name_product' => $orderProduct['title'],
                'id_product' => $orderProduct['product_ref'],
                'url_product' => $baseUrl."/".$orderProduct['url'],
                'url_image_product' => $imagePath
            ];
        }


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