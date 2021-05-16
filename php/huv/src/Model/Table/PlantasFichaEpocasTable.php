<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFichaEpocas Model
 *
 * @property \App\Model\Table\PlantasFichaTable&\Cake\ORM\Association\BelongsTo $PlantasFicha
 * @property \App\Model\Table\PlantasEpocaTable&\Cake\ORM\Association\BelongsTo $PlantasEpoca
 *
 * @method \App\Model\Entity\PlantasFichaEpoca newEmptyEntity()
 * @method \App\Model\Entity\PlantasFichaEpoca newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaEpoca[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFichaEpocasTable extends Table
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

        $this->setTable('plantas_ficha_epocas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFicha', [
            'foreignKey' => 'ficha_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlantasEpoca', [
            'foreignKey' => 'epoca_id',
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
        $rules->add($rules->existsIn(['ficha_id'], 'PlantasFicha'), ['errorField' => 'ficha_id']);
        $rules->add($rules->existsIn(['epoca_id'], 'PlantasEpoca'), ['errorField' => 'epoca_id']);

        return $rules;
    }
}
