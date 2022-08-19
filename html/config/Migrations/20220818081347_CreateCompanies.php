<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCompanies extends AbstractMigration
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
        ->table('companies')
        ->addColumn('business_category_id', 'integer', [
            'null' => true,
            'default' => null
        ])
        ->addForeignKey('business_category_id', 'business_categories', ['id'], [
            'delete' => 'SET NULL'
        ])
        ->addColumn('company_name', 'string', [
            'limit' => 200
        ])
        ->addColumn('company_kana', 'string', [
            'limit' => 200
        ])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')

        ->addIndex('company_name')
        ->addIndex('company_kana')

        ->addIndex('company_name', ['type' => 'fulltext'])

        ->create();
    }
}
