<?php

namespace Forix\Unit05\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        $categoryCountryTable = $setup->getTable('category_countries');
        $data = [
            ['category_id' => 1, 'country_id' => 'US'],
            ['category_id' => 1, 'country_id' => 'CA'],
            ['category_id' => 2, 'country_id' => 'GB'],
            ['category_id' => 2, 'country_id' => 'DE'],
        ];

        $connection->insertMultiple($categoryCountryTable, $data);

        $setup->endSetup();
    }
}
