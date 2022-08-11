<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesFixture
 */
class SalesFixture extends TestFixture
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
                'purchase_date' => '2022-08-11',
                'customer_id' => 1,
                'product_id' => 1,
                'amount' => 1,
                'created' => '2022-08-11 12:59:49',
                'modified' => '2022-08-11 12:59:49',
            ],
        ];
        parent::init();
    }
}
