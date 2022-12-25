<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReceivedMails Model
 *
 * @property \App\Model\Table\ThreadsTable&\Cake\ORM\Association\BelongsTo $Threads
 *
 * @method \App\Model\Entity\ReceivedMail newEmptyEntity()
 * @method \App\Model\Entity\ReceivedMail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReceivedMail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ReceivedMail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReceivedMail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReceivedMail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReceivedMail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReceivedMail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ReceivedMail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReceivedMailsTable extends Table
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

        $this->setTable('received_mails');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Threads', [
            'foreignKey' => 'thread_id',
            'joinType' => 'INNER',
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
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->integer('thread_id')
            ->requirePresence('thread_id', 'create')
            ->notEmptyString('thread_id');

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
        $rules->add($rules->existsIn('thread_id', 'Threads'), ['errorField' => 'thread_id']);

        return $rules;
    }
}
