<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompaniesFixture
 */
class CompaniesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'business_category_id' => 1,
                'company_name' => 'Lorem ipsum dolor sit amet',
                'company_kana' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-11 12:59:23',
                'modified' => '2022-08-11 12:59:23',
            ],
        ];
        parent::init();
    }
}
