<?php

namespace Forix\Unit04\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    protected $categorySetupFactory;

    /**
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        CategorySetupFactory $categorySetupFactory
    )
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $catalogSetup = $this->categorySetupFactory->create(['setup' => $setup]);
        $attrParams = [
            'type' => 'text',
            'label' => 'Custom multiselect attribute',
            'input' => 'multiselect',
            'required' => 0,
            'visible_on_front' => 1,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
            'option' => ['values' => [
                'left',
                'right',
                'up',
                'down'
            ]]
        ];
        $catalogSetup->addAttribute(Product::ENTITY, 'custom_multiselect', $attrParams);

        $setup->endSetup();
    }
}
