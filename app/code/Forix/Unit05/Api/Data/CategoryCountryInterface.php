<?php

namespace Forix\Unit05\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CategoryCountryInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getCategoryCountryId();

    /**
     * @param $categoryCountryId
     * @return \Forix\Unit05\Api\Data\CategoryCountryInterface
     */
    public function setCategoryCountryId($categoryCountryId);

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @param $categoryId
     * @return \Forix\Unit05\Api\Data\CategoryCountryInterface
     */
    public function setCategoryId($categoryId);

    /**
     * @return array
     */
    public function getCountries();

    /**
     * @param array $countries
     * @return \Forix\Unit05\Api\Data\CategoryCountryInterface
     */
    public function setCountries(array $countries);
}
