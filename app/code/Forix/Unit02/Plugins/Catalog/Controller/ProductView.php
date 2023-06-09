<?php

namespace Forix\Unit02\Plugins\Catalog\Controller;

class ProductView
{
    /**
     * @param \Magento\Catalog\Controller\Product\View $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(\Magento\Catalog\Controller\Product\View $subject, $result) {
        /**
         * Customized code here
         */
//        echo '<h1>Customized Product View</h1>';
        return $result;
    }
}
