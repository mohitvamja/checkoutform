<?php

namespace Sale\Ordercomment\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

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
        $setup->startSetup();

        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'order_comment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'OrderComment',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'order_comment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'OrderComment',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'order_comment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'OrderComment',
            ]
        );

        $setup->endSetup();
    }
}
