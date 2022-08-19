<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCustomers extends AbstractMigration
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
        $this
        ->table('customers')

        ->addColumn('customer_cd', 'string')
        ->addColumn('name', 'string', [
            'limit' => 50,
        ])
        ->addColumn('kana', 'string', [
            'limit' => 50,
        ])
        ->addColumn('gender', 'integer', [
            'limit' => 1,
        ])
        ->addColumn('company_id', 'integer', [
            'null' => true,
            'default' => null,
        ])
        ->addForeignKey('company_id', 'companies', ['id'], [
            'delete' => 'SET NULL'
        ])
        ->addColumn('zip', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 10
        ])
        ->addColumn('prefecture_id', 'integer', [
            'null' => true,
            'default' => null,
        ])
        ->addForeignKey('prefecture_id', 'prefectures', ['id'], [
            'delete' => 'SET NULL'
        ])
        ->addColumn('address1', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 200
        ])
        ->addColumn('address2', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 200
        ])
        ->addColumn('phone', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 20
        ])
        ->addColumn('fax', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 20
        ])
        ->addColumn('email', 'string', [
            'null' => true,
            'default' => null,
            'limit' => 100
        ])
        ->addColumn('lasttrade', 'date', [
            'null' => true,
            'default' => null,
        ])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')

        ->addIndex('company_id')
        ->addIndex('email')

        ->addIndex('customer_cd', ['type' => 'fulltext'])
        ->addIndex('name', ['type' => 'fulltext'])
        ->addIndex('kana', ['type' => 'fulltext'])
        ->addIndex('zip', ['type' => 'fulltext'])
        ->addIndex('phone', ['type' => 'fulltext'])
        ->addIndex('email', ['type' => 'fulltext'])  

        ->create();
    }
}
