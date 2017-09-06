<?php
/**
 * Created by Julio de la Hoz.
 * User: talosdigital
 * Date: 7/27/16
 * Time: 5:27 PM
 */

namespace Talos\Eye\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;

class ActionObserver implements ObserverInterface
{
    /**
     * @var LoggerInterface|QueueService
     */
    protected $logger;

    /**
     * SyncObserver constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Execute sales_order_place_after event
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(Observer $observer)
    {
        $info = $observer->getRequest()->getPathInfo();
        $this->logger->debug('Getting action path info --> ', [$info]);
    }
}
