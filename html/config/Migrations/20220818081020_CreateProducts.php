<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProducts extends AbstractMigration
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
        $this->table('products')
        ->addColumn('product_name', 'string', [
            'limit' => 200
        ])
        ->addColumn('unit_price', 'integer')
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')
        ->addIndex('product_name')
        ->create();
    }
}
