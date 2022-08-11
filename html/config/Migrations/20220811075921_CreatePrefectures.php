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

        if ($this->isMigratingUp()) {
            $now = date('Y-m-d H:i:s');
            $table->insert([
                ['id' => 1,  'pref_name' => '北海道', 'created' => $now, 'modified' => $now],
                ['id' => 2,  'pref_name' => '青森県', 'created' => $now, 'modified' => $now],
                ['id' => 3,  'pref_name' => '岩手県', 'created' => $now, 'modified' => $now],
                ['id' => 4,  'pref_name' => '宮城県', 'created' => $now, 'modified' => $now],
                ['id' => 5,  'pref_name' => '秋田県', 'created' => $now, 'modified' => $now],
                ['id' => 6,  'pref_name' => '山形県', 'created' => $now, 'modified' => $now],
                ['id' => 7,  'pref_name' => '福島県', 'created' => $now, 'modified' => $now],
                ['id' => 8,  'pref_name' => '茨城県', 'created' => $now, 'modified' => $now],
                ['id' => 9,  'pref_name' => '栃木県', 'created' => $now, 'modified' => $now],
                ['id' => 10, 'pref_name' => '群馬県', 'created' => $now, 'modified' => $now],
                ['id' => 11, 'pref_name' => '埼玉県', 'created' => $now, 'modified' => $now],
                ['id' => 12, 'pref_name' => '千葉県', 'created' => $now, 'modified' => $now],
                ['id' => 13, 'pref_name' => '東京都', 'created' => $now, 'modified' => $now],
                ['id' => 14, 'pref_name' => '神奈川県', 'created' => $now, 'modified' => $now],
                ['id' => 15, 'pref_name' => '山梨県', 'created' => $now, 'modified' => $now],
                ['id' => 16, 'pref_name' => '長野県', 'created' => $now, 'modified' => $now],
                ['id' => 17, 'pref_name' => '新潟県', 'created' => $now, 'modified' => $now],
                ['id' => 18, 'pref_name' => '富山県', 'created' => $now, 'modified' => $now],
                ['id' => 19, 'pref_name' => '石川県', 'created' => $now, 'modified' => $now],
                ['id' => 20, 'pref_name' => '福井県', 'created' => $now, 'modified' => $now],
                ['id' => 21, 'pref_name' => '岐阜県', 'created' => $now, 'modified' => $now],
                ['id' => 22, 'pref_name' => '静岡県', 'created' => $now, 'modified' => $now],
                ['id' => 23, 'pref_name' => '愛知県', 'created' => $now, 'modified' => $now],
                ['id' => 24, 'pref_name' => '三重県', 'created' => $now, 'modified' => $now],
                ['id' => 25, 'pref_name' => '滋賀県', 'created' => $now, 'modified' => $now],
                ['id' => 26, 'pref_name' => '京都府', 'created' => $now, 'modified' => $now],
                ['id' => 27, 'pref_name' => '大阪府', 'created' => $now, 'modified' => $now],
                ['id' => 28, 'pref_name' => '兵庫県', 'created' => $now, 'modified' => $now],
                ['id' => 29, 'pref_name' => '奈良県', 'created' => $now, 'modified' => $now],
                ['id' => 30, 'pref_name' => '和歌山県', 'created' => $now, 'modified' => $now],
                ['id' => 31, 'pref_name' => '鳥取県', 'created' => $now, 'modified' => $now],
                ['id' => 32, 'pref_name' => '島根県', 'created' => $now, 'modified' => $now],
                ['id' => 33, 'pref_name' => '岡山県', 'created' => $now, 'modified' => $now],
                ['id' => 34, 'pref_name' => '広島県', 'created' => $now, 'modified' => $now],
                ['id' => 35, 'pref_name' => '山口県', 'created' => $now, 'modified' => $now],
                ['id' => 36, 'pref_name' => '徳島県', 'created' => $now, 'modified' => $now],
                ['id' => 37, 'pref_name' => '香川県', 'created' => $now, 'modified' => $now],
                ['id' => 38, 'pref_name' => '愛媛県', 'created' => $now, 'modified' => $now],
                ['id' => 39, 'pref_name' => '高地県', 'created' => $now, 'modified' => $now],
                ['id' => 40, 'pref_name' => '福岡県', 'created' => $now, 'modified' => $now],
                ['id' => 41, 'pref_name' => '佐賀県', 'created' => $now, 'modified' => $now],
                ['id' => 42, 'pref_name' => '長崎県', 'created' => $now, 'modified' => $now],
                ['id' => 43, 'pref_name' => '熊本県', 'created' => $now, 'modified' => $now],
                ['id' => 44, 'pref_name' => '大分県', 'created' => $now, 'modified' => $now],
                ['id' => 45, 'pref_name' => '宮崎県', 'created' => $now, 'modified' => $now],
                ['id' => 46, 'pref_name' => '鹿児島県', 'created' => $now, 'modified' => $now],
                ['id' => 47, 'pref_name' => '沖縄県', 'created' => $now, 'modified' => $now],
            ])
            ->save();
        }
    }
}
