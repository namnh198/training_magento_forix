<?php

namespace Forix\Unit06\Block\Product;

class Vendor extends \Magento\Catalog\Block\Product\AbstractProduct
{
    private $vendorFactory;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Forix\Unit06\Model\VendorFactory $vendorFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->vendorFactory = $vendorFactory;
    }

    public function getVendors()
    {
        /** @var \Forix\Unit06\Model\ResourceModel\Vendor\Collection $vendorCollection */
        $vendorCollection = $this->vendorFactory->create()->getCollection();
        $product = $this->getProduct();
        $vendorCollection->addProductIdFilter($product->getId());
        $vendorCollection->addFieldToFilter('status', 1);
        return $vendorCollection->getItems();
    }
}
