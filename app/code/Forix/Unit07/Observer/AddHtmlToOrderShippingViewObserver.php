<?php

namespace Forix\Unit07\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddHtmlToOrderShippingViewObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $_timezone;

    /**
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     */
    public function __construct(\Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->_timezone = $timezone;
    }

    /**
     * @param EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        if($observer->getElementName() == 'order_shipping_view')
        {
            /** @var \Magento\Framework\View\Layout $layout */
            $layout = $observer->getLayout();
            $orderShippingViewBlock = $layout->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();
            $localeDate = $this->_timezone->scopeDate($order->getStore(), $order->getDeliveryDate());
            $formattedDate = $this->_timezone->formatDate(
                $localeDate,
                \IntlDateFormatter::MEDIUM,
            );
            $deliveryDateBlock = $layout->createBlock('Magento\Framework\View\Element\Template');
            $deliveryDateBlock->setDeliveryDate($formattedDate);
            $deliveryDateBlock->setTemplate('Forix_Unit07::delivery_date.phtml');
            $html = $observer->getTransport()->getOutput() . $deliveryDateBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }
}
