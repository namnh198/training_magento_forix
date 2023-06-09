<?php

namespace Forix\Unit06\Block\Adminhtml\Vendor\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('vendor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Vendor Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('vendor_general', [
            'label' => __('General'),
            'title' => __('General'),
            'content' => $this->getLayout()->createBlock(
                \Forix\Unit06\Block\Adminhtml\Vendor\Edit\Tabs\General::class
            )->toHtml(),
            'active' => true
        ]);
        $this->addTab('vendor_products', [
            'label' => __('Assign Product'),
            'title' => __('Assign Product'),
            'url' => $this->getUrl('*/*/products', ['_current' => true]),
            'active' => false,
            'class' => 'ajax'
        ]);
        return parent::_beforeToHtml();
    }
}
