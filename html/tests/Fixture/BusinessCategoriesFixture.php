<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BusinessCategoriesFixture
 */
class BusinessCategoriesFixture extends TestFixture
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
                'business_category_name' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-11 12:54:38',
                'modified' => '2022-08-11 12:54:38',
            ],
        ];
        parent::init();
    }
}
