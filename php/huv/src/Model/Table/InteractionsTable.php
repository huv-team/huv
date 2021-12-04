<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interactions Model
 *
 * @property \App\Model\Table\PlantsTable&\Cake\ORM\Association\BelongsToMany $Plants
 *
 * @method \App\Model\Entity\Interaction newEmptyEntity()
 * @method \App\Model\Entity\Interaction newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Interaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interaction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Interaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interaction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interaction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interaction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interaction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class InteractionsTable extends Table
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

        $this->setTable('interactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Origin', [
            'className' => 'Plants',
            'foreignKey' => 'plant_id',
        ]);
        
        $this->belongsToMany('Targets', [
            'className' => 'Plants',
            'foreignKey' => 'interaction_id',
            'targetForeignKey' => 'plant_id',
            'joinTable' => 'interactions_plants',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
            ->allowEmptyString('description');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type')
            ->inList('type', array_keys(Configure::read("Constants.interactionTypes")));

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
        $rules->add($rules->existsIn(['plant_id'], 'Origin'), ['errorField' => 'plant_id']);

        return $rules;
    }
}
