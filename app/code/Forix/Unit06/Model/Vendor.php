<?php

namespace Forix\Unit06\Model;

use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected $_eventPrefix = 'forix_vendor';

    protected function _construct()
    {
        $this->_init(ResourceModel\Vendor::class);
    }

    public function getProducts(Vendor $object)
    {
        $tbl = $this->getResource()->getTable(
            ResourceModel\Vendor::TABLE
        );
        $select = $this->getResource()->getConnection()->select()
            ->from(
                $tbl,
                ['product_id']
            )->where(
                'vendor_id = ?',
                (int)$object->getId()
            );
        return $this->getResource()->getConnection()->fetchCol($select);
    }

    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }
}
