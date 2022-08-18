<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBusinessCategories extends AbstractMigration
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
        $this->table('business_categories')
        ->addColumn('business_category_name', 'string', [
            'default' => null,
            'limit' => 200
        ])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime')
        ->create();
    }
}
