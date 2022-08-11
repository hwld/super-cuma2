<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $customer_cd
 * @property string $name
 * @property string $kana
 * @property int $gender
 * @property int $company_id
 * @property string $zip
 * @property int $prefecture_id
 * @property string $address1
 * @property string $address2
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property \Cake\I18n\FrozenDate $lasttrade
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Prefecture $prefecture
 * @property \App\Model\Entity\Sale[] $sales
 */
class Customer extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'customer_cd' => true,
        'name' => true,
        'kana' => true,
        'gender' => true,
        'company_id' => true,
        'zip' => true,
        'prefecture_id' => true,
        'address1' => true,
        'address2' => true,
        'phone' => true,
        'fax' => true,
        'email' => true,
        'lasttrade' => true,
        'created' => true,
        'modified' => true,
        'company' => true,
        'prefecture' => true,
        'sales' => true,
    ];
}
