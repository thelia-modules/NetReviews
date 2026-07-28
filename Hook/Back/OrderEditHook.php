<?php

declare(strict_types=1);

/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*************************************************************************************/

namespace NetReviews\Hook\Back;

use NetReviews\Form\SendOrderForm;
use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\NetReviews;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Form\TheliaFormFactory;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Template\Parser\ParserResolver;

/**
 * Adds the "Send order to NetReviews" panel at the bottom of the order edit screen.
 * Ported from AdminIncludes/order-bottom.html.
 */
class OrderEditHook extends BaseHook
{
    public function __construct(
        private readonly TheliaFormFactory $formFactory,
        ?EventDispatcherInterface $dispatcher = null,
        ?ParserResolver $parserResolver = null,
    ) {
        parent::__construct($dispatcher, $parserResolver);
    }

    public static function getSubscribedHooks(): array
    {
        if (!NetReviews::isThelia3()) {
            return []; // Thelia 2 uses NetReviews\Hook\BackHook (config.xml) instead.
        }

        return [
            // Distinct method name from NetReviews\Hook\BackHook::onOrderEditBottom: the hook
            // registry keys module_hook rows by (module, hook, method), so a shared name would
            // let the two classes overwrite each other's classname on Thelia 3.
            'order-edit.bottom' => [
                ['type' => 'back', 'method' => 'onOrderEditBottomTwig'],
            ],
        ];
    }

    public function onOrderEditBottomTwig(HookRenderEvent $event): void
    {
        $orderId = (int) $event->getArgument('order');

        $queued = NetreviewsOrderQueueQuery::create()->findOneByOrderId($orderId);

        $event->add(
            $this->render('NetReviews/order-edit.html.twig', [
                'order_id' => $orderId,
                'treated_at' => null !== $queued ? $queued->getTreatedAt() : null,
                'send_order_form' => $this->formFactory
                    ->createForm(SendOrderForm::getName(), FormType::class)
                    ->createView()
                    ->getView(),
            ])
        );
    }
}
