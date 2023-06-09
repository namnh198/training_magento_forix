<?php

namespace Forix\Unit01\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class LogRequestPathInfo implements ObserverInterface
{

    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $request = $observer->getRequest();
        if (! $request instanceof \Magento\Framework\App\RequestInterface) {
            return;
        }

        $this->logger->debug('Request Path Info: ' . $request->getPathInfo());
    }
}
