<?php

namespace Forix\Unit06\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class Verify extends AbstractMassAction
{
    /**
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collection
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collection
    )
    {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collection;
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    protected function massAction(AbstractCollection $collection)
    {
        foreach ($collection as $order) {
            $order->setRequireVerification(0)->save();
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->getComponentRefererUrl());
        return $resultRedirect;
    }
}
