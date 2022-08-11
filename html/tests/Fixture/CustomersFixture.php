<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomersFixture
 */
class CustomersFixture extends TestFixture
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
                'customer_cd' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'kana' => 'Lorem ipsum dolor sit amet',
                'gender' => 1,
                'company_id' => 1,
                'zip' => 'Lorem ip',
                'prefecture_id' => 1,
                'address1' => 'Lorem ipsum dolor sit amet',
                'address2' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor ',
                'fax' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor sit amet',
                'lasttrade' => '2022-08-11',
                'created' => '2022-08-11 12:59:28',
                'modified' => '2022-08-11 12:59:28',
            ],
        ];
        parent::init();
    }
}
