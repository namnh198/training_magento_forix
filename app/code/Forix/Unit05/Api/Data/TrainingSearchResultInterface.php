<?php

namespace Forix\Unit05\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TrainingSearchResultInterface extends SearchResultsInterface
{
    /**
     * @api
     * @return TrainingInterface[]
     */
    public function getItems();

    /**
     * @param TrainingInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}
