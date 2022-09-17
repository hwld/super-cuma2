<?php

declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'email',
                'uid' => 'uid',
                'isAdmin' => false,
                'created' => '2022-08-11 12:59:44',
                'modified' => '2022-08-11 12:59:44',
            ],
        ];
        parent::init();
    }
}
