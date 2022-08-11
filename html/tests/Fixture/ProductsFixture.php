<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
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
                'product_name' => 'Lorem ipsum dolor sit amet',
                'unit_price' => 1,
                'created' => '2022-08-11 12:59:40',
                'modified' => '2022-08-11 12:59:40',
            ],
        ];
        parent::init();
    }
}
