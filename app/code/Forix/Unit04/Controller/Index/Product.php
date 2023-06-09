<?php

namespace Forix\Unit04\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Product extends \Magento\Framework\App\Action\Action
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(Context $context, CollectionFactory $productCollectionFactory)
    {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $productCollection = $this->productCollectionFactory->create();
        // Add attributes to select
        $productCollection->addAttributeToSelect('name')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('description');

        // Add filters
        $productCollection->addAttributeToFilter('category_ids', 5)
            ->addAttributeToFilter('status', 1);

        // Add ordering
        $productCollection->addAttributeToSort('price', 'DESC');

        // Print the select query
        echo $productCollection->getSelect();
    }
}
