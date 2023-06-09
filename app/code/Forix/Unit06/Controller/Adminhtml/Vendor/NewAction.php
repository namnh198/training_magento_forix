<?php

namespace Forix\Unit06\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends \Magento\Backend\App\Action
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
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultFoward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        return $resultFoward->forward('edit');
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
