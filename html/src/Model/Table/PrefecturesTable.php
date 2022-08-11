<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prefectures Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\HasMany $Customers
 *
 * @method \App\Model\Entity\Prefecture newEmptyEntity()
 * @method \App\Model\Entity\Prefecture newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Prefecture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prefecture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prefecture findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Prefecture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prefecture[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prefecture|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prefecture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prefecture[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prefecture[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prefecture[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prefecture[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrefecturesTable extends Table
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

        $this->setTable('prefectures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Customers', [
            'foreignKey' => 'prefecture_id',
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
            ->scalar('pref_name')
            ->maxLength('pref_name', 20)
            ->requirePresence('pref_name', 'create')
            ->notEmptyString('pref_name');

        return $validator;
    }
}
