<?php

namespace Forix\Unit05\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TrainingSearchResultInterface extends SearchResultsInterface
{
    /**
     * @api
     * @return \Forix\Unit05\Api\Data\TrainingInterface[]
     */
    public function getItems();

    /**
     * @param \Forix\Unit05\Api\Data\TrainingInterface[]|null $items
     * @return $this
     */
    public function setItems(array $items = null);
}
