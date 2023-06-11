<?php

namespace Forix\Unit05\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CategoryCountry extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('category_countries', 'category_country_id');
    }
}
