<?php

namespace Forix\Unit05\Model;

use Forix\Unit05\Api\Data\TrainingInterface;
use Magento\Framework\Model\AbstractModel;

class Training extends AbstractModel implements TrainingInterface
{
    protected function _construct()
    {
        $this->_init('Forix\Unit05\Model\ResourceModel\Training');
    }

    /**
     * @inheirtdoc
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @inheirtdoc
     */
    public function getName()
    {
        return $this->_getData('name');
    }

    /**
     * @inheirtdoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData('created_at', $createdAt);
    }

    /**
     * @inheirtdoc
     */
    public function getCreatedAt()
    {
        return $this->_getData('created_at');
    }

    /**
     * @inheirtdoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData('updated_at', $updatedAt);
    }

    /**
     * @inheirtdoc
     */
    public function getUpdatedAt()
    {
        return $this->_getData('updated_at');
    }
}
