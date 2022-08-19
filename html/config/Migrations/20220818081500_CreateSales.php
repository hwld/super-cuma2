<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSales extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('sales')
        ->addColumn('purchase_date', 'date')
        ->addColumn('customer_id', 'integer', [
            'null' => true,
            'default' => null
        ])
        ->addForeignKey('customer_id', 'customers', ['id'], [
            'delete' => 'SET NULL'
        ])
        ->addColumn('product_id', 'integer', [
            'null' => true,
            'default' => null
        ])
        ->addForeignKey('product_id', 'products', ['id'], [
            'delete' => 'SET NULL'
        ])
        ->addColumn('amount', 'integer', [
            'default' => null
        ])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')

        ->addIndex('purchase_date')
        ->addIndex('customer_id')
        ->addIndex('product_id')

        ->create();
    }
}
