<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreatePrefectures extends AbstractMigration
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
        $table = $this->table('prefectures')
        ->addColumn('pref_name', 'string', [
            'default' => null,
            'limit' => 20
        ])
        ->addColumn('created', 'datetime')
        ->addColumn('modified', 'datetime') 
        ->addIndex('pref_name', ['type' => 'fulltext']);
        $table->create();
    }
}
