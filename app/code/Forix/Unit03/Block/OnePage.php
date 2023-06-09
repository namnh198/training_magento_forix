<?php

namespace Forix\Unit03\Block;

class OnePage extends \Magento\Framework\View\Element\Template
{
    /**
     * @return string
     */
    protected function _toHtml()
    {
        return '<strong>Hello World from block</strong>';
    }
}
