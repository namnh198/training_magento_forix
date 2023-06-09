<?php

namespace Forix\Unit06\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * ResultPageFactory
     *
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * Index Constructor
     *
     * @param Context $context context
     * @param PageFactory $resultPageFactory pageFactory
     */
    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Forix_Unit06::vendor');
        $resultPage->addBreadcrumb(__('Manage Vendors'), __('Manage Vendors'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Vendors'));
        return $resultPage;
    }

    /**
     * Is the user allowed to view the brand grid.
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Forix_Unit06::vendor');
    }
}
