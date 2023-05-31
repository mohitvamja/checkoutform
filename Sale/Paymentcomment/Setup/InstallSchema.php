<?php
namespace Sale\Paymentcomment\Setup;

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
            'paycomment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'PayComment',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'paycomment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'PayComment',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'paycomment',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'PayComment',
            ]
        );

        

        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'yesno',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'yesno',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'yesno',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'yesno',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'yesno',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'yesno',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'paycommenttextarea',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'paycommenttextarea',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'paycommenttextarea',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'paycommenttextarea',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'paycommenttextarea',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'paycommenttextarea',
            ]
        );

        $setup->endSetup();
    }
}
