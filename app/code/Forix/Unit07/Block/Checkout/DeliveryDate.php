<?php

namespace Forix\Unit07\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class DeliveryDate implements LayoutProcessorInterface
{

    public function process($jsLayout)
    {
        $shippingAddress = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children'];

        $shippingAddress['delivery_date'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'options' => [],
                'id' => 'delivery-date'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.delivery_date',
            'label' => 'Delivery Date',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 200,
            'id' => 'delivery-date'
        ];
        return $jsLayout;
    }
}
