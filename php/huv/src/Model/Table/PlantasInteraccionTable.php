<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasInteraccion Model
 *
 * @property \App\Model\Table\PlantasPlantaTable&\Cake\ORM\Association\BelongsTo $PlantasPlanta
 *
 * @method \App\Model\Entity\PlantasInteraccion newEmptyEntity()
 * @method \App\Model\Entity\PlantasInteraccion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccion get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasInteraccion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasInteraccion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasInteraccionTable extends Table
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

        $this->setTable('plantas_interaccion');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasPlanta', [
            'foreignKey' => 'target_id',
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
            ->scalar('relacion')
            ->maxLength('relacion', 4294967295)
            ->allowEmptyString('relacion');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 10)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

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
        $rules->add($rules->existsIn(['target_id'], 'PlantasPlanta'), ['errorField' => 'target_id']);

        return $rules;
    }
}
