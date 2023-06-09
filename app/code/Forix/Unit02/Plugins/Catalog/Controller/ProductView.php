<?php

namespace Forix\Unit02\Plugins\Catalog\Controller;

class ProductView
{
    public function afterExecute(\Magento\Catalog\Controller\Product\View $subject, $result) {
        /**
         * Customized code here
         */
//        echo '<h1>Customized Product View</h1>';
        return $result;
    }
}
