<?php

namespace Forix\Unit06\Controller\Adminhtml\Vendor;

use Forix\Unit06\Model\VendorFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Helper\Js;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $vendorFactory;

    protected $jsHelper;

    public function __construct(
        Context $context,
        Js $jsHelper,
        VendorFactory $vendorFactory
    )
    {
        parent::__construct($context);
        $this->jsHelper = $jsHelper;
        $this->vendorFactory = $vendorFactory;
    }

    public function execute()
    {
        $vendorId = $this->getRequest()->getParam('vendor_id');
        $data = $this->getRequest()->getPostValue();
        $vendor = $this->vendorFactory->create();
        try {
            if ($vendorId) {
                $vendor->load($vendorId);
            }
            $vendor->addData($data);
            $vendor->setData('entity_id', $vendor->getId());
            $vendor->save();
            if (isset($data['products'])) {
                $productIds = $this->jsHelper->decodeGridSerializedInput($data['products']);
                $vendor->saveProducts($vendor, $productIds);
            }

            $this->messageManager->addSuccessMessage(__('Vendor saved successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('Something went wrong while saving the vendor.')
            );
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $back = $this->getRequest()->getParam('back');
        switch ($back) {
            case 'edit':
                $resultRedirect->setPath('*/*/edit', ['vendor_id' => $vendor->getId()]);
                break;
            default:
                $resultRedirect->setPath('*/*/');
                break;
        }
        return $resultRedirect;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Forix_Unit06::vendor');
    }
}
