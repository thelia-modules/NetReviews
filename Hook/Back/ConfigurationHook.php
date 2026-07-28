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

use NetReviews\Form\ConfigurationForm;
use NetReviews\NetReviews;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Form\TheliaFormFactory;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Template\Parser\ParserResolver;

/**
 * Renders the NetReviews configuration screen in the default-twig back-office.
 * Ported from the Thelia 2 BackHook + AdminIncludes Smarty templates: the form is
 * prepared here as a FormView and rendered by Twig.
 */
class ConfigurationHook extends BaseHook
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
            'module.configuration' => [
                ['type' => 'back', 'method' => 'onModuleConfiguration'],
            ],
            'module.config-js' => [
                ['type' => 'back', 'method' => 'onModuleConfigurationJs'],
            ],
        ];
    }

    public function onModuleConfiguration(HookRenderEvent $event): void
    {
        if ('NetReviews' !== $event->getArgument('modulecode')) {
            return;
        }

        $event->add(
            $this->render('NetReviews/module-configuration.html.twig', [
                'config_form' => $this->formFactory
                    ->createForm(ConfigurationForm::getName(), FormType::class)
                    ->createView()
                    ->getView(),
            ])
        );
    }

    public function onModuleConfigurationJs(HookRenderEvent $event): void
    {
        if ('NetReviews' !== $event->getArgument('modulecode')) {
            return;
        }

        $event->add($this->render('NetReviews/module-config-js.html.twig'));
    }
}
