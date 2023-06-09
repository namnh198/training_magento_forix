<?php

namespace Forix\Unit07\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveDeliveryDateToOrderObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();
        $order->setDeliveryDate($quote->getDeliveryDate());
    }
}
