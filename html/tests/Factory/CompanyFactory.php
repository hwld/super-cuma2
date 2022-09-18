<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * CompanyFactory
 *
 * @method \App\Model\Entity\Company getEntity()
 * @method \App\Model\Entity\Company[] getEntities()
 * @method \App\Model\Entity\Company|\App\Model\Entity\Company[] persist()
 * @method static \App\Model\Entity\Company get(mixed $primaryKey, array $options = [])
 */
class CompanyFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'Companies';
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
                'business_category_id' => 1,
                'company_name' => 'Lorem ipsum dolor sit amet',
                'company_kana' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-08-11 12:59:23',
                'modified' => '2022-08-11 12:59:23',
            ];
        });
    }
}
