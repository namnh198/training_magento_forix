<?php

namespace Forix\Unit05\Api;

use Forix\Unit05\Api\Data\TrainingSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TrainingRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return TrainingSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
