<?php


namespace NetReviews\Command;


use NetReviews\Model\NetreviewsOrderQueue;
use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\Service\OrderService;
use Propel\Runtime\ActiveQuery\Criteria;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thelia\Command\ContainerAwareCommand;

class SendOrderCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName("module:NetReviews:SendOrder")
            ->setDescription("Send orders from queue to netreviews");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>Send orders from queue...</info>'));

        try {
            $this->initRequest();

            /** @var OrderService $netreviewsOrderService */
            $netreviewsOrderService = $this->getContainer()->get('netreviews.order.service');

            $ordersInQueue = NetreviewsOrderQueueQuery::create()
                ->filterByTreatedAt(null, Criteria::ISNULL)
                ->find();

            $orderCount = $ordersInQueue->count();
            $output->writeln(sprintf("<info>$orderCount orders found</info>"));

            /** @var NetreviewsOrderQueue $order */
            foreach ($ordersInQueue as $order) {
                $orderId = $order->getOrderId();
                $response = $netreviewsOrderService->sendOrderToNetReviews($orderId);
                $return = $response->return;

                if ($return != 1) {
                    $debug = $response->debug;
                    $output->writeln(sprintf("<error>Error on order id $orderId: $debug</error>"));
                }
            }

        } catch (\Exception $e) {
            $output->writeln('');
            $output->writeln('<error>'.$e->getMessage().'</error>');
        }

        $output->writeln(sprintf("<info>End</info>"));
    }
}
