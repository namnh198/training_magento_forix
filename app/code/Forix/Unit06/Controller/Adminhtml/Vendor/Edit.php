<?php

namespace Forix\Unit06\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * ResultPageFactory
     *
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    protected $vendorFactory;

    protected $coreRegistry;

    /**
     * Index Constructor
     *
     * @param Context $context context
     * @param PageFactory $resultPageFactory pageFactory
     */
    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory,
        \Forix\Unit06\Model\VendorFactory $vendorFactory,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->vendorFactory = $vendorFactory;
        $this->coreRegistry = $registry;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $vendorId = $this->getRequest()->getParam('vendor_id');
        $vendor = $this->vendorFactory->create();
        if ($vendorId) {
            $vendor->load($vendorId);
            $vendor->setVendorId($vendor->getId());
        }

        $this->coreRegistry->register('vendor', $vendor);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Forix_Unit06::vendor');
        $resultPage->addBreadcrumb(__('Vendors'), __('Vendors'));
        $title = $vendor->getId() ? __('Edit Vendor: %1', $vendor->getVendorName()) : __('New Vendor');
        $resultPage->addBreadcrumb($title, $title);
        $resultPage->getConfig()->getTitle()->prepend($title);
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
