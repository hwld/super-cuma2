<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * BusinessCategoryFactory
 *
 * @method \App\Model\Entity\BusinessCategory getEntity()
 * @method \App\Model\Entity\BusinessCategory[] getEntities()
 * @method \App\Model\Entity\BusinessCategory|\App\Model\Entity\BusinessCategory[] persist()
 * @method static \App\Model\Entity\BusinessCategory get(mixed $primaryKey, array $options = [])
 */
class BusinessCategoryFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'BusinessCategories';
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
                'business_category_name' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-11 12:54:38',
                'modified' => '2022-08-11 12:54:38',
            ];
        });
    }
}
