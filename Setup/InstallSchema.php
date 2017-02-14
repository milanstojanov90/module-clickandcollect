<?php
/**
 * MageClass_ClickAndCollect Magento Extension
 *
 * @category    MageClass
 * @package     MageClass_ClickAndCollect
 * @author      Milan Stojanov <milan.stojanov@outlook.com>
 * @website    http://www.mageclass.com
 */

namespace MageClass\ClickAndCollect\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'pickup_date',
            [
                'type' => 'datetime',
                'nullable' => true,
                'comment' => 'Pick Up Date',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'pickup_store',
            [
                'type' => 'text',
                'nullable' => true,
                'comment' => 'Pick Up Store',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'pickup_date',
            [
                'type' => 'datetime',
                'nullable' => true,
                'comment' => 'Pick Up Date',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'pickup_store',
            [
                'type' => 'text',
                'nullable' => true,
                'comment' => 'Pick Up Store',
            ]
        );

        /**
         * Create table 'mageclass_clickandcollect_store'
         */     
        if (!$installer->tableExists('mageclass_clickandcollect_store')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('mageclass_clickandcollect_store')
                )->addColumn(
                    'store_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'identity' => true, 'nullable' => false, 'primary' => true],
                    'Store ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => false],
                    'Address'
                )
                ->addColumn(
                    'working_time',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => false],
                    'Working Time'
                )
                ->addColumn(
                    'latitude',
                    Table::TYPE_DECIMAL,
                    '18,14',
                    ['nullable' => false],
                    'Latitude'
                )
                ->addColumn(
                    'longitude',
                    Table::TYPE_DECIMAL,
                    '18,14',
                    ['nullable' => false],
                    'Longitude'
                )                 
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Creation Time'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Update Time'
                )               
                ->addColumn(
                    'is_active',
                    Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'default' => '1'],
                    'Status'
                )
                ->setComment(
                    'ClickandCollect Stores'
                );
            $installer->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}