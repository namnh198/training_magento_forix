<?php

namespace Forix\Unit06\Block\Adminhtml\Edit;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton implements ButtonProviderInterface
{
    private $urlBuilder;

    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    public function getButtonData()
    {
        return [
            'id' => 'delete',
            'label' => __('Delete'),
            'on_click' => "deleteConfirm('" .__('Are you sure you want to delete this games?') ."', '"
                . $this->getDeleteUrl() . "', {data: {}})",
            'class' => 'delete primary',
            'sort_order' => 20
        ];
    }

    protected function getDeleteUrl()
    {
        return $this->urlBuilder->getUrl('*/*/delete', ['_current' => true, '_query' => ['isAjax' => null]]);
    }
}
