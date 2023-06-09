<?php

namespace Forix\Unit01\Plugins\Catalog\Model;

class ProductPricePlugin
{
    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return float
     */
    public function afterGetPrice(
        \Magento\Catalog\Model\Product $subject,
        $result
    ) {
        // modify price
        return $result * 1.25;
    }
}
