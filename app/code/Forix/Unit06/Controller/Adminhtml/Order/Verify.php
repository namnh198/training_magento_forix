<?php

namespace Forix\Unit06\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class Verify extends AbstractMassAction
{

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collection
    )
    {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collection;
    }

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
