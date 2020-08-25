<?php
namespace AHT\CRUD\Setup;
 
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
        public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
        {
                $installer = $setup;
                $installer->startSetup();
                if (!$installer->tableExists('post')) {
                        $table = $installer->getConnection()->newTable(
                                $installer->getTable('post')
                        )
                                ->addColumn(
                                        'post_id',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                        null,
                                        [
                                                'identity' => true,
                                                'nullable' => false,
                                                'primary'  => true,
                                                'unsigned' => true,
                                        ],
                                        'Post ID'
                                )
                                ->addColumn(
                                        'name',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                        255,
                                        ['nullable =&gt; false'],
                                        'Post Name'
                                )
                                ->addColumn(
                                        'url_key',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                        255,
                                        [],
                                        'Post URL Key'
                                )
                                ->addColumn(
                                        'post_content',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                        '64k',
                                        [],
                                        'Post Post Content'
                                )
                                ->addColumn(
                                        'tags',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                        255,
                                        [],
                                        'Post Tags'
                                )
                                ->addColumn(
                                        'status',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                        1,
                                        [],
                                        'Post Status'
                                )
                                ->addColumn(
                                        'featured_image',
                                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                        255,
                                        [],
                                        'Post Featured Image'
                                )->setComment('Post Table');
                        $installer->getConnection()->createTable($table);
 
                        $installer->getConnection()->addIndex(
                                $installer->getTable('post'),
                                $setup->getIdxName(
                                        $installer->getTable('post'),
                                        ['name','url_key','post_content','tags','featured_image'],
                                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                                ),
                                ['name','url_key','post_content','tags','featured_image'],
                                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                        );
                }
                $installer->endSetup();
        }
}