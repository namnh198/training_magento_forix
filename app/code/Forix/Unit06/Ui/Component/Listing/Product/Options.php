<?php

namespace Forix\Unit06\Ui\Component\Listing\Product;

use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [

            ['label' => 'Default', 'value' => ''],
            ['label' => '1', 'value' => '1'],
            ['label' => '2', 'value' => '2'],
            ['label' => '3', 'value' => '3']
        ];
    }
}
