<?php
/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\Customers\Setup;

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
		$installer = $setup;
		$installer->startSetup();

		/**
		 * Creating table aks_customers
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('aks_customers')
		)->addColumn(
			'customers_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Customer Name'
		)->addColumn(
			'dob',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			255,
			['nullable' => true,'default' => null],
			'Date Of Birth'
		)->setComment(
            'Aks Customers Table'
        );
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}