<?php

namespace Forix\Unit04\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    protected $categorySetupFactory;

    public function __construct(
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $catalogSetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $catalogSetup->addAttribute(Product::ENTITY, 'vendor', [
            'label' => 'Vendor',
            'visible_on_front' => 1,
            'required' => 0,
            'global' => ScopedAttributeInterface::SCOPE_STORE
        ]);
        $setup->endSetup();
    }
}
