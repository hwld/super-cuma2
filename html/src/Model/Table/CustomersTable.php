<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\PrefecturesTable&\Cake\ORM\Association\BelongsTo $Prefectures
 * @property \App\Model\Table\SalesTable&\Cake\ORM\Association\HasMany $Sales
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
        ]);
        $this->belongsTo('Prefectures', [
            'foreignKey' => 'prefecture_id',
        ]);
        $this->hasMany('Sales', [
            'foreignKey' => 'customer_id',
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
            ->scalar('customer_cd')
            ->maxLength('customer_cd', 255)
            ->requirePresence('customer_cd', 'create')
            ->notEmptyString('customer_cd');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('kana')
            ->maxLength('kana', 50)
            ->requirePresence('kana', 'create')
            ->notEmptyString('kana');

        $validator
            ->integer('gender')
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->integer('company_id')
            ->requirePresence('company_id', 'create')
            ->notEmptyString('company_id');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 10)
            ->requirePresence('zip', 'create')
            ->allowEmptyString('zip');
            
        $validator
            ->integer('prefecture_id')
            ->requirePresence('prefecture_id', 'create')
            ->notEmptyString('prefecture_id');

        $validator
            ->scalar('address1')
            ->maxLength('address1', 200)
            ->requirePresence('address1', 'create')
            ->allowEmptyString('address1');
            
        $validator
            ->scalar('address2')
            ->maxLength('address2', 200)
            ->requirePresence('address2', 'create')
            ->allowEmptyString('address2');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 20)
            ->requirePresence('fax', 'create')
            ->allowEmptyString('fax');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email');

        $validator
            ->date('lasttrade')
            ->requirePresence('lasttrade', 'create')
            ->allowEmptyDate('lasttrade');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('company_id', 'Companies'), ['errorField' => 'company_id']);
        $rules->add($rules->existsIn('prefecture_id', 'Prefectures'), ['errorField' => 'prefecture_id']);

        return $rules;
    }
}
