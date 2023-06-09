<?php

namespace Forix\Unit06\Ui\Component\Options;

class Types implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => 'RPG', 'value' => 'RPG'],
            ['label' => 'RTS', 'value' => 'RTS'],
            ['label' => 'MMO', 'value' => 'MMO'],
            ['label' => 'Simulator', 'value' => 'Simulator'],
            ['label' => 'Shooter', 'value' => 'Shooter']
        ];
    }
}
