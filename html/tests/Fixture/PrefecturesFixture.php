<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PrefecturesFixture
 */
class PrefecturesFixture extends TestFixture
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
                'pref_name' => 'Lorem ipsum dolor ',
                'created' => '2022-08-11 12:59:35',
                'modified' => '2022-08-11 12:59:35',
            ],
        ];
        parent::init();
    }
}
