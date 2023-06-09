<?php

namespace Forix\Unit06\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{
    const TABLE = 'vendor_entity';

    protected function _construct()
    {
        $this->_init(self::TABLE, 'entity_id');
    }
}
