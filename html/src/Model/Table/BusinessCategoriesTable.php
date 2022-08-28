<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessCategories Model
 *
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\HasMany $Companies
 *
 * @method \App\Model\Entity\BusinessCategory newEmptyEntity()
 * @method \App\Model\Entity\BusinessCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BusinessCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BusinessCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BusinessCategoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('business_categories');
        $this->setDisplayField('business_category_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Companies', [
            'foreignKey' => 'business_category_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('business_category_name')
            ->maxLength('business_category_name', 200)
            ->requirePresence('business_category_name', 'create')
            ->notEmptyString('business_category_name');

        return $validator;
    }
}
