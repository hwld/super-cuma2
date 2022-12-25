<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Threads Model
 *
 * @property \App\Model\Table\ReceivedMailsTable&\Cake\ORM\Association\HasMany $ReceivedMails
 * @property \App\Model\Table\SendMailsTable&\Cake\ORM\Association\HasMany $SendMails
 *
 * @method \App\Model\Entity\Thread newEmptyEntity()
 * @method \App\Model\Entity\Thread newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Thread[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Thread get($primaryKey, $options = [])
 * @method \App\Model\Entity\Thread findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Thread patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Thread[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Thread|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Thread saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Thread[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thread[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thread[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Thread[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ThreadsTable extends Table
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

        $this->setTable('threads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReceivedMails', [
            'foreignKey' => 'thread_id',
        ]);
        $this->hasMany('SendMails', [
            'foreignKey' => 'thread_id',
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
            ->scalar('thread_name')
            ->requirePresence('thread_name', 'create')
            ->notEmptyString('thread_name');

        return $validator;
    }
}
