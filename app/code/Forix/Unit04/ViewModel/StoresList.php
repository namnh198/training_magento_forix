<?php

namespace Forix\Unit04\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use \Magento\Framework\View\Element\Block\ArgumentInterface;
use \Magento\Catalog\Model\CategoryFactory;
use \Magento\Store\Model\StoreManager;

class StoresList implements ArgumentInterface
{
    /**
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * @var CategoryFactory
     */
    protected $categoryFactory;

    /**
     * StoresList constructor.
     * @param CategoryFactory $categoryFactory
     * @param StoreManager $storeManager
     */
    public function __construct(
        CategoryFactory $categoryFactory,
        StoreManager    $storeManager
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getRootCategories()
    {
        $storesList = $this->storeManager->getStores();
        $catalogCategory = $this->categoryFactory->create();
        $stores = [];
        foreach ($storesList as $store) {
            $categoryName = $catalogCategory->load($store->getRootCategoryId())->getName();
            $stores[] = [
                'store_name' => $store->getName(),
                'root_category_name' => $categoryName
            ];
        }
        $stores = array_map(function ($item) {
            $string = '<b>STORE</b> ' . $item['store_name'] . '<br>';
            $string .= ' <b>ROOT CATEGORY</b> ' . $item['root_category_name'] . '<br><br>';
            return $string;
        }, $stores);
        return implode('', $stores);
    }

}
