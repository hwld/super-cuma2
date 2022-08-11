<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property int $business_category_id
 * @property string $company_name
 * @property string $company_kana
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\BusinessCategory $business_category
 * @property \App\Model\Entity\Customer[] $customers
 */
class Company extends Entity
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
        'business_category_id' => true,
        'company_name' => true,
        'company_kana' => true,
        'created' => true,
        'modified' => true,
        'business_category' => true,
        'customers' => true,
    ];
}
