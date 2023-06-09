<?php

namespace Forix\Unit06\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class OrderRequireVerification implements ObserverInterface
{
    private $state;

    public function __construct(
        \Magento\Framework\App\State $state
    )
    {
        $this->state = $state;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();
        if (! $order instanceof \Magento\Sales\Model\Order) {
            return;
        }
        $areaCode = $this->state->getAreaCode();
        $verification = $areaCode != 'adminhtml';
        $order->setRequireVerification($verification);
    }
}
