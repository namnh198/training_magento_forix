<?php

namespace Forix\Unit06\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    private $vendor;

    public function __construct(
        \Forix\Unit06\Model\Vendor $vendor
    ) {
        $this->vendor = $vendor;
    }

    public function toOptionArray()
    {
        $options = [['label' => '', 'value' => '']];
        foreach ($this->vendor->getAvailableStatuses() as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
