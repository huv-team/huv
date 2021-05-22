<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InteractionsPlants Model
 *
 * @property \App\Model\Table\InteractionsTable&\Cake\ORM\Association\BelongsTo $Interactions
 * @property \App\Model\Table\PlantsTable&\Cake\ORM\Association\BelongsTo $Plants
 *
 * @method \App\Model\Entity\InteractionsPlant newEmptyEntity()
 * @method \App\Model\Entity\InteractionsPlant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\InteractionsPlant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InteractionsPlant get($primaryKey, $options = [])
 * @method \App\Model\Entity\InteractionsPlant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\InteractionsPlant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionsPlant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\InteractionsPlant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InteractionsPlant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InteractionsPlant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InteractionsPlant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\InteractionsPlant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InteractionsPlant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class InteractionsPlantsTable extends Table
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

        $this->setTable('interactions_plants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Interactions', [
            'foreignKey' => 'interaction_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Plants', [
            'foreignKey' => 'plant_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmptyString('type');

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
        $rules->add($rules->existsIn(['interaction_id'], 'Interactions'), ['errorField' => 'interaction_id']);
        $rules->add($rules->existsIn(['plant_id'], 'Plants'), ['errorField' => 'plant_id']);

        return $rules;
    }
}
