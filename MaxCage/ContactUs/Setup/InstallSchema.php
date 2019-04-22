<?php
/**
* Copyright © Magento, Inc. All rights reserved.
* See COPYING.txt for license details.
*/

namespace MaxCage\ContactUs\Setup;

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
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table contact_us
         */
        $customer_enqiry_table = $installer->getConnection()->newTable(
            $installer->getTable('contact_us')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Contact us enquiry identity'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer name'
        )->addColumn(
            'telephone', Table::TYPE_TEXT, 50,
            ['nullable' => false, 'default' => ''],
            'Telephone'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer email'
        )->addColumn(
            'message',
            Table::TYPE_TEXT,
            '2k',
            ['nullable' => false],
            'Customer Message'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Enquiry creation time'
        )->addColumn(
            'status',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Enquiry status'
        )->setComment(
            'Customer enquiry status'
        );

        $installer->getConnection()->createTable($customer_enqiry_table);


    }
}