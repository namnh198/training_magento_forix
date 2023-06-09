<?php

namespace Forix\Unit05\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Training extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('training_repository', 'id');
    }
}
