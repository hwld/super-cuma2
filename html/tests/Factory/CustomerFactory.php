<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * CustomerFactory
 *
 * @method \App\Model\Entity\Customer getEntity()
 * @method \App\Model\Entity\Customer[] getEntities()
 * @method \App\Model\Entity\Customer|\App\Model\Entity\Customer[] persist()
 * @method static \App\Model\Entity\Customer get(mixed $primaryKey, array $options = [])
 */
class CustomerFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'Customers';
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
                'email' => 'example@example.com',
                'lasttrade' => '2022-08-11',
                'created' => '2022-08-11 12:59:28',
                'modified' => '2022-08-11 12:59:28',
            ];
        });
    }

    public function withCompanyAndPrefecture($parameter = null): self
    {
        $company_fields = ['id' => 1];
        $prefecture_fields = ['id' => 1];

        if (isset($parameter['company'])) {
            $company_fields = $parameter['company'];
        }

        if (isset($parameter['prefecture'])) {
            $prefecture_fields = $parameter['prefecture'];
        }

        return $this->with(
            'Companies',
            CompanyFactory::make($company_fields)->with(
                'BusinessCategories',
                BusinessCategoryFactory::make()
            )
        )->with(
            'Prefectures',
            PrefectureFactory::make($prefecture_fields)
        );
    }

    public function deleteAll()
    {
        $this->getTable()->deleteAll([]);
        CompanyFactory::make()->getTable()->deleteAll([]);
        PrefectureFactory::make()->getTable()->deleteAll([]);
        BusinessCategoryFactory::make()->getTable()->deleteAll([]);
    }
}
