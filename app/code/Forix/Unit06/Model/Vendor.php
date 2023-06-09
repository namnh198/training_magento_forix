<?php

namespace Forix\Unit06\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected $_eventPrefix = 'forix_vendor';

    protected function _construct()
    {
        $this->_init(ResourceModel\Vendor::class);
    }

    /**
     * @throws LocalizedException
     */
    public function getProducts(Vendor $object)
    {
        $resource = $this->getResource();
        $select = $resource->getConnection()->select()
            ->from('vendor_product', ['product_id'])
            ->where(
                'vendor_id = ?', (int) $object->getId()
            );

        return $resource->getConnection()->fetchCol($select);
    }

    /**
     * @throws LocalizedException
     */
    public function saveProducts(Vendor $vendor, array $product)
    {
        $connection = $this->getResource()->getConnection();
        $oldProducts = $this->getProducts($vendor);
        $deletedProducts = array_diff($oldProducts, $product);
        $productsInDb = array_intersect($oldProducts, $product);

        foreach ($productsInDb as $value) {
            $pos = array_search($value, $product);
            unset($product[$pos]);
        }

        if (!empty($deletedProducts)) {
            $where = [
                'vendor_id = ?' => (int) $vendor->getId(),
                'product_id IN (?)' => $deletedProducts
            ];
            $connection->delete('vendor_product', $where);
        }

        if ($product) {
            $data = [];
            foreach ($product as $productId) {
                $data[] = [
                    'vendor_id' => (int) $vendor->getId(),
                    'product_id' => (int) $productId
                ];
            }

            $connection->insertMultiple('vendor_product', $data);
        }
    }

    /**
     * @throws \Exception
     */
    public function deleteProducts()
    {
        $connection = $this->getResource()->getConnection();
        $connection->delete('vendor_product', ['vendor_id = ?' => (int) $this->getId()]);
    }

    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }
}
