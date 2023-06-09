<?php

namespace Forix\Unit02\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;

class HelloWorld extends \Magento\Backend\App\Action
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_redirect('catalog/category/edit/id/38');
    }
}
