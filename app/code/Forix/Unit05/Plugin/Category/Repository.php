<?php

namespace Forix\Unit05\Plugin\Category;

use Forix\Unit05\Model\ResourceModel\CategoryCountry\CollectionFactory;
use Magento\Catalog\Api\Data\CategoryExtensionFactory;

class Repository
{
    protected $categoryExtensionFactory;

    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
        CategoryExtensionFactory $categoryExtensionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->categoryExtensionFactory = $categoryExtensionFactory;
    }
    public function afterGet(
        \Magento\Catalog\Api\CategoryRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\CategoryInterface $category
    ) {
        $extension = $category->getExtensionAttributes();
        if (! $extension) {
            $extension = $this->categoryExtensionFactory->create();
        }
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('category_id', $category->getId());
        $extension->setCountries($collection->getItems());

        $category->setExtensionAttributes($extension);
        return $category;
    }
}
