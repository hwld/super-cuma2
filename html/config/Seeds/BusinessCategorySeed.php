<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * BusinessCategory seed.
 */
class BusinessCategorySeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $categories = ['製造業', '農業', '不動産業', 'サービス業', 'その他'];
        $now = date('Y-m-d H-i-s');
        $data = array_map(function ($category, $index) use($now) {
            return ['id' => $index + 1, 'business_category_name' => $category, 'created' => $now, 'modified' => $now];
        }, $categories, array_keys($categories));

        $table = $this->table('business_categories');
        $table->insert($data)->save();
    }
}
