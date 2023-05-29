<?php

namespace Mytek\ErpSynchronize\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $connection = $setup->getConnection();
            $connection->addColumn(
                $setup->getTable('mytek_erp_synchronize'),
                'UPDATED_DATE',
                [
                    'type' => Table::TYPE_TIMESTAMP,
                    'nullable' => true,
                    'comment' => 'date generated when update ok'
                ]
            );
            $connection->addColumn(
                $setup->getTable('mytek_erp_synchronize'),
                '_3MOIS',
                [
                    'type' => Table::TYPE_TEXT,
                    'nullable' => false,
                    'comment' => '3 monthly payment'
                ]
            );
        }
    }
}