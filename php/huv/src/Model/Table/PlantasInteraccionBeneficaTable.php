<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasInteraccionBenefica Model
 *
 * @property \App\Model\Table\PlantasInteraccionTable&\Cake\ORM\Association\BelongsTo $PlantasInteraccion
 * @property \App\Model\Table\PlantasPlantaTable&\Cake\ORM\Association\BelongsTo $PlantasPlanta
 *
 * @method \App\Model\Entity\PlantasInteraccionBenefica newEmptyEntity()
 * @method \App\Model\Entity\PlantasInteraccionBenefica newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccionBenefica[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasInteraccionBeneficaTable extends Table
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

        $this->setTable('plantas_interaccion_benefica');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasInteraccion', [
            'foreignKey' => 'interaccion_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlantasPlanta', [
            'foreignKey' => 'planta_id',
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
        $rules->add($rules->existsIn(['interaccion_id'], 'PlantasInteraccion'), ['errorField' => 'interaccion_id']);
        $rules->add($rules->existsIn(['planta_id'], 'PlantasPlanta'), ['errorField' => 'planta_id']);

        return $rules;
    }
}
