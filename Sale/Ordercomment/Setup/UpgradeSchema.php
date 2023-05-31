<?php

namespace Sale\Ordercomment\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    // public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
    //     $installer = $setup;

    //     $installer->startSetup();

    //     if(version_compare($context->getVersion(), '1.2.0', '<')) {
    //         $installer->getConnection()->addColumn(
    //             $installer->getTable('quote'),
    //             'agree',
    //             [
    //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
    //                 'visible'  => true,
    //                 'default' => 0,
    //                 'comment' => 'Custom Condition'
    //             ]
    //         );
    //          $installer->getConnection()->addColumn(
    //             $installer->getTable('sales_order'),
    //             'agree',
    //             [
    //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
    //                 'visible'  => true,
    //                 'default' => 0,
    //                 'comment' => 'Custom Condition'
    //             ]
    //         );
    //          $installer->getConnection()->addColumn(
    //             $installer->getTable('sales_order_grid'),
    //             'agree',
    //             [
    //                 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
    //                 'visible'  => true,
    //                 'default' => 0,
    //                 'comment' => 'Custom Condition'
    //             ]
    //         );
    //     }
    //     $installer->endSetup();
    // }
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->dropColumn($setup->getTable('sales_order'), 'agree');
        }
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->dropColumn($setup->getTable('sales_order_grid'), 'agree');
        }
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->dropColumn($setup->getTable('quote'), 'agree');
        }
        $setup->endSetup();
    }
}