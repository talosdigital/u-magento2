<?php

namespace Talos\Restaurant\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('talos_restaurant_main_course');
        if (!$setup->tableExists($tableName)) {
            $table = $setup->getConnection()->newTable($tableName);

            $table->addColumn('id', Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true])
                ->setComment("Main course's table")
                ->setOption('type', 'InnoDb')
                ->setOption('charset', 'utf8');

            $table->addColumn('price', Table::TYPE_INTEGER, null, ['nullable' => false]);
            $table->addColumn('name', Table::TYPE_TEXT, null, ['nullable' => false]);
            $table->addColumn('description', Table::TYPE_TEXT, null, ['nullable' => true]);

            $setup->getConnection()->createTable($table);
        }

        $tableName = $setup->getTable('talos_restaurant_appetizer');
        if (!$setup->tableExists($tableName)) {
           $table = $setup->getConnection()->newTable($tableName);

           $table->addColumn('id', Table::TYPE_INTEGER, null, [
               'identity' => true,
               'unsigned' => true,
               'nullable' => false,
               'primary' => true])
               ->setComment("Appetizer's table")
               ->setOption('type', 'InnoDb')
               ->setOption('charset', 'utf8');

           $table->addColumn('price', Table::TYPE_INTEGER, null, ['nullable' => false]);
           $table->addColumn('name', Table::TYPE_TEXT, null, ['nullable' => false]);
           $table->addColumn('description', Table::TYPE_TEXT, null, ['nullable' => false]);

           $setup->getConnection()->createTable($table);
        }

        $tableName = $setup->getTable('talos_restaurant_menu');
        if (!$setup->tableExists($tableName)) {
            $table = $setup->getConnection()->newTable($tableName);

            $table->addColumn('id', Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true])
                ->setComment("Menu's table")
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');

            $table->addColumn('name', Table::TYPE_TEXT, null, ['nullable' => false]);
            $table->addColumn('main_course_id', Table::TYPE_INTEGER, null, [
                'unsigned' => true,
                'nullable' => false
            ]);
            $table->addForeignKey(
                $setup->getFkName($tableName, 'main_course_id', 'talos_restaurant_main_course', 'id'),
                'main_course_id',
                $setup->getTable('talos_restaurant_main_course'),
                'id',
                Table::ACTION_CASCADE
            );

            $setup->getConnection()->createTable($table);
        }

        $tableName = $setup->getTable('talos_restaurant_menu_appetizer');
        if (!$setup->tableExists($tableName)) {
            $table = $setup->getConnection()->newTable($tableName);

            $table->addColumn('id', Table::TYPE_INTEGER, null, [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true])
                ->setComment('Menu Appetizer relationship')
                ->setOption('type', 'InnoDb')
                ->setOption('charset', 'utf8');

            // The type of the foreign key must match the type of the referenced key, in this case it should be an
            // unsigned integer
            $table->addColumn('menu_id', Table::TYPE_INTEGER, null, [
                'unsigned' => true,
                'nullable' => false
            ])->addForeignKey(
                $setup->getFkName($tableName, 'menu_id', 'talos_restaurant_menu', 'id'),
                'menu_id',
                $setup->getTable('talos_restaurant_menu'),
                'id',
                Table::ACTION_CASCADE
            );

            $table->addColumn('appetizer_id', Table::TYPE_INTEGER, null, [
                'unsigned' => true,
                'nullable' => false,
            ])->addForeignKey(
                $setup->getFkName($tableName, 'appetizer_id', 'talos_restaurant_appetizer', 'id'),
                'appetizer_id',
                $setup->getTable('talos_restaurant_appetizer'),
                'id',
                Table::ACTION_CASCADE
            );

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}