<?php

namespace Forix\Unit06\Controller\Adminhtml\Game;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Forix_Unit06::games';

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $backendPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $backendPage->setActiveMenu('Forix_Unit06::game');
        $backendPage->addBreadcrumb(__('Dashboard'), __('Games'));
        $backendPage->getConfig()->getTitle()->prepend(__('Games'));
        return $backendPage;
    }
}
