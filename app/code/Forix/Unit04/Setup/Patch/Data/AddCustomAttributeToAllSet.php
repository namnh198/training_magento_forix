<?php

namespace Forix\Unit04\Setup\Patch\Data;

use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;

class AddCustomAttributeToAllSet implements DataPatchInterface
{
    /**
     * @var CategorySetupFactory
     */
    protected $categorySetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * CategoryAttrUpdate constructor.
     * @param CategorySetupFactory $categorySetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */

    public function __construct(
        CategorySetupFactory     $categorySetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return DataPatchInterface|void
     * @throws LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $catalogSetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $catalogSetup->addAttribute(
            Product::ENTITY,
            'custom_attribute_code',
            [
                'type' => 'varchar',
                'label' => 'Custom Attribute',
                'input' => 'text',
                'required' => false,
                'sort_order' => 50,
                'global' => Attribute::SCOPE_STORE,
                'group' => 'General',
                'used_in_product_listing' => true,
                'visible_on_front' => true,
            ]
        );

        // Assign the attribute to all attribute sets
        $attributeSetIds = $catalogSetup->getAllAttributeSetIds(Product::ENTITY);
        foreach ($attributeSetIds as $attributeSetId) {
            $catalogSetup->addAttributeToSet(
                Product::ENTITY,
                $attributeSetId,
                'General',
                'custom_attribute_code'
            );
        }
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
