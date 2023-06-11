<?php

namespace Forix\Unit05\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $connection = $setup->getConnection();

        $categoryTable = $setup->getTable('catalog_category_entity');
        $countryTable = $setup->getTable('directory_country');

        $categoryCountryTable = $setup->getTable('category_countries');
        $table = $connection->newTable($categoryCountryTable)
            ->addColumn(
                'category_country_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Category Country ID'
            )
            ->addColumn(
                'category_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Category ID'
            )
            ->addColumn(
                'country_id',
                Table::TYPE_TEXT,
                2,
                ['nullable' => false],
                'Country ID'
            )
            ->addIndex(
                $setup->getIdxName($categoryCountryTable, ['category_id']),
                ['category_id']
            )
            ->addIndex(
                $setup->getIdxName($categoryCountryTable, ['country_id']),
                ['country_id']
            )
            ->addForeignKey(
                $setup->getFkName($categoryCountryTable, 'category_id', $categoryTable, 'entity_id'),
                'category_id',
                $categoryTable,
                'entity_id',
                Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($categoryCountryTable, 'country_id', $countryTable, 'country_id'),
                'country_id',
                $countryTable,
                'country_id',
                Table::ACTION_CASCADE
            )
            ->setComment('Category Countries');

        $connection->createTable($table);

        $setup->endSetup();
    }
}
