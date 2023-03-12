<?php


namespace Navyug\DonationProduct\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Navyug\DonationProduct\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $tableNavyugDonationProductDonations = $setup->getConnection()->newTable(
            $setup->getTable('Navyug_donations')
        );

        $tableNavyugDonationProductDonations->addColumn(
            'donations_id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'name'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'sku',
            Table::TYPE_TEXT,
            255,
            [],
            'sku'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'order_item_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'order_item_id'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'order_id'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'order_status',
            Table::TYPE_TEXT,
            null,
            [],
            'order_status'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'amount',
            Table::TYPE_DECIMAL,
            '12,4',
            [],
            'amount'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'invoiced',
            Table::TYPE_BOOLEAN,
            null,
            [],
            'invoiced'
        );

        $tableNavyugDonationProductDonations->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [],
            'Creation date'
        );

        $tableNavyugDonationProductDonations->addIndex(
            $installer->getIdxName('Navyug_donations', ['order_item_id']),
            ['order_item_id']
        );

        $setup->getConnection()->createTable($tableNavyugDonationProductDonations);

        $setup->endSetup();
    }
}
