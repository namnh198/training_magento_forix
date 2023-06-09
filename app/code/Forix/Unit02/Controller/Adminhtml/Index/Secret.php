<?php

namespace Forix\Unit02\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Secret extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    public function execute()
    {
        echo 'Allow Access';
    }

    protected function _isAllowed()
    {
        $secret = $this->getRequest()->getParam('secret');
        if(! $secret) {
            return false;
        }
        return parent::_isAllowed();
    }
}
