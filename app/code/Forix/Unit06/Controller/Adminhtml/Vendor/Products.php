<?php

namespace Forix\Unit06\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\LayoutFactory;

class Products extends Action
{
    protected $resultLayoutFactory;

    public function __construct(
        Action\Context $context,
        LayoutFactory $resultLayoutFactory
    ) {
        parent::__construct($context);
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    /**
     * Products Action
     *
     * @return \Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $resultLayout = $this->resultLayoutFactory->create();
        $resultLayout->getLayout()
            ->getBlock('vendor.edit.tab.products')
            ->setSelectedProducts(
                $this->getRequest()->getPost('vendor_products')
            );

        return $resultLayout;
    }
}
