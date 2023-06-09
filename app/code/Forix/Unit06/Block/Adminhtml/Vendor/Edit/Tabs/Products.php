<?php

namespace Forix\Unit06\Block\Adminhtml\Vendor\Edit\Tabs;

use Forix\Unit06\Model\VendorFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Exception\FileSystemException;

class Products extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var CollectionFactory
     */
    protected $productCollection;

    /**
     * @var VendorFactory
     */
    protected $vendorFactory;

    /**
     * @param Context $context
     * @param Data $backendHelper
     * @param VendorFactory $vendorFactory
     * @param CollectionFactory $productCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $backendHelper,
        \Forix\Unit06\Model\VendorFactory $vendorFactory,
        CollectionFactory $productCollection,
        array $data = []
    ) {
        $this->vendorFactory = $vendorFactory;
        $this->productCollection = $productCollection;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     * @throws FileSystemException
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('productsGrid');
        $this->setDefaultSort('vendor_product_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return Products
     */
    protected function _prepareCollection()
    {
        $collection = $this->productCollection->create();
        $collection->addAttributeToSelect('name');
        $collection->addAttributeToSelect('sku');
        $collection->addAttributeToSelect('price');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Products
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'product_ids',
            [
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'product_ids',
                'align' => 'center',
                'index' => 'entity_id',
                'values' => $this->getSelectedProducts(),
            ]
        );

        $this->addColumn(
            'product_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name'
            ]
        );
        $this->addColumn(
            'sku',
            [
                'header' => __('Sku'),
                'index' => 'sku'
            ]
        );
        $this->addColumn(
            'price',
            [
                'header' => __('Price'),
                'type' => 'currency',
                'index' => 'price'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getSelectedProducts()
    {
        $vendor = $this->getVendor();
        $vendorProducts = $vendor->getProducts($vendor);

        if (!is_array($vendorProducts)) {
            $vendorProducts = [];
        }

        return $vendorProducts;
    }

    /**
     * @return \Forix\Unit06\Model\Vendor
     */
    protected function getVendor()
    {
        $vendorId = $this->getRequest()->getParam('vendor_id');
        $vendor = $this->vendorFactory->create();
        if ($vendorId) {
            $vendor->load($vendorId);
        }
        return $vendor;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/products', ['_current' => true]);
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return '';
    }

    /**
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return true
     */
    public function isHidden()
    {
        return true;
    }
}
