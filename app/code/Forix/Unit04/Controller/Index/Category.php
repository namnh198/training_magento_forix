<?php

namespace Forix\Unit04\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Category extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
