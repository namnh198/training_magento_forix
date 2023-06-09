<?php

namespace Forix\Unit05\Controller\Index;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Context;

class Customer extends \Magento\Framework\App\Action\Action
{
    /**
     * @var CustomerRepository
     */
    private $customerRepositry;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;

    /**
     * @param Context $context
     * @param CustomerRepository $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     */
    public function __construct(
        Context $context,
        CustomerRepository $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder
    ) {
        parent::__construct($context);
        $this->customerRepositry = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->setHeader('Content-Type', 'text/plain');

        foreach ($this->getCustomers() as $customer) {
            echo sprintf(
                "%s - %s - %s (%d)\n",
                $customer->getFirstname(),
                $customer->getLastname(),
                $customer->getEmail(),
                $customer->getId()
            );
        }
    }

    /**
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getCustomers()
    {
        $this->addCustomerFilter();
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->customerRepositry->getList($searchCriteria)->getItems();
    }

    /**
     * @return void
     */
    private function addCustomerFilter()
    {
        $emailFilter = $this->filterBuilder
            ->setField('email')
            ->setConditionType('like')
            ->setValue('%@example.com')
            ->create();
        $nameFilter = $this->filterBuilder
            ->setField('firstname')
            ->setConditionType('eq')
            ->setValue('Veronica')
            ->create();
        $this->filterGroupBuilder->addFilter($emailFilter);
        $this->filterGroupBuilder->addFilter($nameFilter);

        $filterGroup = $this->filterGroupBuilder->create();
        $this->searchCriteriaBuilder->setFilterGroups([$filterGroup]);
    }
}
