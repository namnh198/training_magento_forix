<?php

namespace Forix\Unit05\Controller\Index;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Context;

class Product extends \Magento\Framework\App\Action\Action
{
    private $productRepository;

    private $searchCriteriaBuilder;

    private $sortOrderBuilder;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    public function execute()
    {
        $this->getResponse()->setHeader('Content-Type', 'text/plain');
        foreach ($this->getProducts() as $product) {
            echo sprintf(
                "%s - %s (%d)\n",
                $product->getName(),
                $product->getSku(),
                $product->getId());
        }
    }

    private function getProducts()
    {
        $this->addSortOrder();
        $this->addProductFilter();
        $this->addProductPaging();
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $products = $this->productRepository->getList($searchCriteria);
        return $products->getItems();
    }

    private function addProductFilter()
    {
        $this->searchCriteriaBuilder
            ->addFilter('type_id', Configurable::TYPE_CODE)
            ->addFilter('name', 'M%', 'like');
    }

    private function addProductPaging()
    {
        $this->searchCriteriaBuilder
            ->setPageSize(6)
            ->setCurrentPage(1);
    }

    private function addSortOrder()
    {
        $this->searchCriteriaBuilder->addSortOrder(
            $this->sortOrderBuilder
                ->setField('entity_id')
                ->setDirection('asc')
                ->create()
        );
    }
}
