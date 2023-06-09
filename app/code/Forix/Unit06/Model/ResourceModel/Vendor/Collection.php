<?php

namespace Forix\Unit06\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            \Forix\Unit06\Model\Vendor::class,
            \Forix\Unit06\Model\ResourceModel\Vendor::class
        );
        $this->_map['fields']['vendor_id'] = 'main_table.vendor_id';
    }

    public function addProductIdFilter($productId)
    {
        $this->getSelect()->join(
            ['vp' => 'vendor_product'],
            'main_table.entity_id = vp.vendor_id',
        )->where(
            'vp.product_id = ?', $productId
        );
        return $this;
    }
}
