<?php


namespace NetReviews\Command;


use NetReviews\Model\NetreviewsOrderQueue;
use NetReviews\Model\NetreviewsOrderQueueQuery;
use NetReviews\Service\OrderService;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Symfony\Component\Console\Command\Command;
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

            $con = Propel::getConnection();

            $ordersInQueue = "
                                SELECT n.order_id 'order_id' 
                                FROM netreviews_order_queue n 
                                JOIN `order` o on n.order_id = o.id 
                                WHERE o.status_id =4 AND n.treated_at IS NULL";

            $stmt = $con->prepare($ordersInQueue);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $orderCount = count($results);
            $output->writeln(sprintf("<info>$orderCount orders found</info>"));

            foreach ($results as $order) {
                try {
                    $orderId = $order['order_id'];
                    $response = $netreviewsOrderService->sendOrderToNetReviews($orderId);
                    $return = $response->return;

                    if ($return != 1) {
                        $debug = $response->debug;
                        throw new \Exception($debug);
                    }
                } catch (\Exception $e) {
                    $output->writeln(sprintf("<error>Error on order id ".$order['order_id'].":".$e->getMessage()."</error>"));
                }
            }
        } catch (\Exception $e) {
            $output->writeln('');
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return Command::FAILURE;
        }

        $output->writeln(sprintf("<info>End</info>"));

        return Command::SUCCESS;
    }
}
