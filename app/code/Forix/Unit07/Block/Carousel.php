<?php

namespace Forix\Unit07\Block;

class Carousel extends \Magento\Framework\View\Element\Template
{
    /**
     * @return string[]
     */
    public function getImageManufactures()
    {
        return [
            'images/manufactures/1.webp',
            'images/manufactures/2.jpg',
            'images/manufactures/3.webp',
            'images/manufactures/4.png',
            'images/manufactures/5.png',
            'images/manufactures/6.webp',
            'images/manufactures/7.jpg',
            'images/manufactures/8.png',
        ];
    }

    /**
     * @return array
     */
    public function getManufactures()
    {
        $manufactures = [];
        foreach ($this->getImageManufactures() as $img) {
            $manufactures[] = $this->getViewFileUrl( 'Forix_Unit07::'. $img);
        }

        return $manufactures;
    }

    /**
     * @return false|string
     */
    public function getManufacturesJson()
    {
        return json_encode($this->getManufactures());
    }
}
