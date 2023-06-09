<?php

namespace Forix\Unit03\Plugin\Catalog\Block\Product\View;

class Description
{
    /**
     * @param \Magento\Catalog\Block\Product\View\Description $subject
     * @return void
     */
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        $subject->getProduct()->setDescription('custom description');
        $subject->setTemplate('Forix_Unit03::product/descriptions.phtml');
    }
}
