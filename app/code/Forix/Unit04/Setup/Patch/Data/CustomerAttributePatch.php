<?php

namespace Forix\Unit04\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CustomerAttributePatch implements DataPatchInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * CustomerAttr constructor.
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        CustomerSetupFactory     $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(
            Customer::ENTITY,
            'custom_priority',
            [
                'label' => 'Priority',
                'type' => 'int',
                'input' => 'select',
                'source' => \Forix\Unit04\Model\Entity\Attribute\Frontend\Source\CustomerPriority::class,
                'required' => 0,
                'system' => 0,
                'position' => 100,
            ]
        );
        $customerSetup->getEavConfig()
            ->getAttribute('customer', 'custom_priority')
            ->setData('used_in_forms', ['adminhtml_customer'])
            ->save();
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
