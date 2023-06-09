<?php

namespace Forix\Unit05\Model;

use Forix\Unit05\Api\Data\TrainingInterface;
use Forix\Unit05\Api\Data\TrainingInterfaceFactory;
use Forix\Unit05\Api\Data\TrainingSearchResultInterfaceFactory;
use Forix\Unit05\Api\TrainingRepositoryInterface;
use Forix\Unit05\Model\ResourceModel\Training\Collection;
use Forix\Unit05\Model\ResourceModel\Training\CollectionFactory;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;

class TrainingRepository implements TrainingRepositoryInterface
{
    /**
     * @var TrainingSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param TrainingSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        TrainingSearchResultInterfaceFactory $searchResultFactory,
        CollectionFactory                    $collectionFactory
    )
    {
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @inheirtdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $searchResults = $this->searchResultFactory->create();
        $this->applySearchCriteriaToCollection($searchCriteria, $collection);
        $examples = $this->convertCollectionToDataItemsArray($collection);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($examples);
        return $searchResults;
    }

    /**
     * @param FilterGroup $filterGroup
     * @param Collection $collection
     * @return void
     */
    private function addFilterGroupToCollection(
        FilterGroup $filterGroup,
        Collection  $collection
    )
    {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filters) {
            $filters = ! is_array($filters) ? [$filters] : $filters;
            foreach ($filters as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param Collection $collection
     * @return array
     */
    private function convertCollectionToDataItemsArray(
        Collection $collection
    )
    {
        return $collection->getItems();
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function applySearchCriteriaToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection              $collection
    )
    {
        $this->applySearchCriteriaFiltersToCollection(
            $searchCriteria,
            $collection
        );
        $this->applySearchCriteriaSortOrdersToCollection(
            $searchCriteria,
            $collection
        );
        $this->applySearchCriteriaPagingToCollection(
            $searchCriteria,
            $collection
        );
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function applySearchCriteriaFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection              $collection
    )
    {
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function applySearchCriteriaSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection              $collection
    )
    {
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $isAscending = $sortOrder->getDirection() == SortOrder::SORT_ASC;
                $collection->addOrder(
                    $sortOrder->getField(),
                    $isAscending ? 'ASC' : 'DESC'
                );
            }
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function applySearchCriteriaPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
    }
}
