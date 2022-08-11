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
        ->addColumn('purchase_date', 'date', [
            'default' => null
        ])
        ->addColumn('customer_id', 'integer', [
            'default' => null
        ])
        ->addColumn('product_id', 'integer', [
            'default' => null
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
