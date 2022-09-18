<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * PrefectureFactory
 *
 * @method \App\Model\Entity\Prefecture getEntity()
 * @method \App\Model\Entity\Prefecture[] getEntities()
 * @method \App\Model\Entity\Prefecture|\App\Model\Entity\Prefecture[] persist()
 * @method static \App\Model\Entity\Prefecture get(mixed $primaryKey, array $options = [])
 */
class PrefectureFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'Prefectures';
    }

    /**
     * Defines the factory's default values. This is useful for
     * not nullable fields. You may use methods of the present factory here too.
     *
     * @return void
     */
    protected function setDefaultTemplate(): void
    {
        $this->setDefaultData(function (Generator $faker) {
            return [
                'id' => 1,
                'pref_name' => 'Lorem ipsum dolor ',
                'created' => '2022-08-11 12:59:35',
                'modified' => '2022-08-11 12:59:35',
            ];
        });
    }
}
