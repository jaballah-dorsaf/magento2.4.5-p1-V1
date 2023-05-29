<?php
namespace Mytek\ErpSynchronize\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface {
    public function install( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable(
            $installer->getTable( 'mytek_erp_synchronize' )
        )->addColumn(
                'CODE',
                Table::TYPE_TEXT,
                50,
                [ 'identity' => false, 'nullable' => false, 'primary' => true ],
                'Ref articles'

        ) ->addColumn(
                'PRIX',
                Table::TYPE_TEXT,
                '2M',
                ['nullable' => false ],
                'Price'

        )->addColumn(
                'PRIX_SPECIFIQUE',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Promotion price'

        )->addColumn(
                'CODE_BARRES',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'CODE A BARRES'

        )->addColumn(
                'FAMILLE',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Categorie'

        )->addColumn(
                'DES',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'DESCRIPTION'
        )->addColumn(
                '_3MOIS',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Promotion price'

        )->addColumn(
                '_6MOIS',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Promotion price'
        
        )->addColumn(
                '_9MOIS',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Promotion price'
        
        )->addColumn(
                '_12MOIS',
                Table::TYPE_TEXT,
                255,
                [ 'nullable' => false ],
                'Promotion price'
        )
        ->setComment(
            'ERP synchronize Table'
        );

        $table2 = $installer->getConnection()->newTable(
                $installer->getTable( 'mytek_erp_warehouse' )
        //     )->addColumn(
        //             'ID',
        //             Table::TYPE_INTEGER,
        //             50,
        //             [ 'identity' => true, 'nullable' => false, 'primary' => true ],
        //             'ID'
    
            ) ->addColumn(
                    'DEPO',
                    Table::TYPE_TEXT,
                    255,
                    [ 'nullable' => false, 'primary' => true],
                    'Num magazin'
 
    
            ) ->addColumn(
                    'QTESTK',
                    Table::TYPE_TEXT,
                    255,
                    [ 'nullable' => false ],
                    'Quantity'
    
            )->addColumn(
                    'MSG_ZERO_STK',
                    Table::TYPE_TEXT,
                    255,
                    [ 'nullable' => false ],
                    'MSG when zero stk'
            )->addColumn(
                    'REF_ARTICLE',
                    Table::TYPE_TEXT,
                    50,
                    [ 'identity' => false, 'nullable' => false, 'primary' => true ],
                    'REF_ARTICLE'

            )->addForeignKey( // Add foreign key for table entity
                $installer->getFkName(
                    'mytek_erp_warehouse', // New table
                    'REF_ARTICLE', // Column in New Table
                    'mytek_erp_synchronize', // Reference Table
                    'CODE' // Column in Reference table
                ),
                'REF_ARTICLE', // New table column
                $installer->getTable('mytek_erp_synchronize'), // Reference Table
                'CODE', // Reference Table Column
                // When the parent is deleted, delete the row with foreign key
                Table::ACTION_CASCADE
            )

            ->setComment(
                'Ad Warehouse Table'
            );

































        $installer->getConnection()->createTable( $table );
        $installer->getConnection()->createTable( $table2 );

        $installer->endSetup();
    }
}