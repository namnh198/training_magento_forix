<?php

namespace Forix\Unit06\Ui\DataProvider\Product;

use Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable\Attribute\Collection as AttributesCollection;
use Magento\Framework\Data\Collection;
use Magento\Ui\DataProvider\AddFilterToCollectionInterface;

class AddConfigurationOptions implements AddFilterToCollectionInterface
{
    protected $attributeCollection = null;

    public function __construct(AttributesCollection $collection)
    {
        $this->attributeCollection = $collection;
    }

    public function addFilter(Collection $collection, $field, $condition = null)
    {
        if (isset($condition['eq']) && ($numberOfOptions = $condition['eq'])) {
            $select = clone
            $this->attributeCollection->getSelect();
            $select->reset(\Zend_Db_Select::COLUMNS)
                ->columns(array('product_id', 'COUNT(*) as cnt'))
                ->group('product_id');
            $res = $this->attributeCollection->getConnection()->fetchAll($select);
            $ids = [];
            foreach ($res as $opt) {
                if ($opt['cnt'] == $numberOfOptions) {
                    $ids[] = $opt['product_id'];
                }
            }
            $collection->addFieldToFilter('entity_id', ['in' => $ids]);
        }
    }
}
