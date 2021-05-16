<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFicha Model
 *
 * @property \App\Model\Table\PlantasPlantaTable&\Cake\ORM\Association\BelongsTo $PlantasPlanta
 *
 * @method \App\Model\Entity\PlantasFicha newEmptyEntity()
 * @method \App\Model\Entity\PlantasFicha newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFicha[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFicha get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFicha findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFicha patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFicha[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFicha|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFicha saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFicha[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFicha[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFicha[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFicha[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFichaTable extends Table
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

        $this->setTable('plantas_ficha');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasPlanta', [
            'foreignKey' => 'planta_id',
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
            ->integer('volumen_maceta_ltr')
            ->allowEmptyString('volumen_maceta_ltr');

        $validator
            ->integer('profundidad_cm')
            ->allowEmptyString('profundidad_cm');

        $validator
            ->scalar('tamano')
            ->maxLength('tamano', 200)
            ->allowEmptyString('tamano');

        $validator
            ->integer('horas_sol_min')
            ->allowEmptyString('horas_sol_min');

        $validator
            ->integer('horas_sol_max')
            ->allowEmptyString('horas_sol_max');

        $validator
            ->scalar('riego')
            ->maxLength('riego', 200)
            ->allowEmptyString('riego');

        $validator
            ->boolean('tutorado')
            ->requirePresence('tutorado', 'create')
            ->notEmptyString('tutorado');

        $validator
            ->integer('distancia_max_cm')
            ->allowEmptyString('distancia_max_cm');

        $validator
            ->integer('temperatura_max')
            ->allowEmptyString('temperatura_max');

        $validator
            ->integer('temperatura_min')
            ->allowEmptyString('temperatura_min');

        $validator
            ->boolean('tolera_sombra')
            ->requirePresence('tolera_sombra', 'create')
            ->notEmptyString('tolera_sombra');

        $validator
            ->integer('distancia_min_cm')
            ->allowEmptyString('distancia_min_cm');

        $validator
            ->integer('tiempo_cultivo_min_dias')
            ->allowEmptyString('tiempo_cultivo_min_dias');

        $validator
            ->integer('tiempo_cultivo_max_dias')
            ->allowEmptyString('tiempo_cultivo_max_dias');

        $validator
            ->scalar('fecundacion')
            ->maxLength('fecundacion', 20)
            ->allowEmptyString('fecundacion');

        $validator
            ->boolean('aporque')
            ->requirePresence('aporque', 'create')
            ->notEmptyString('aporque');

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
        $rules->add($rules->existsIn(['planta_id'], 'PlantasPlanta'), ['errorField' => 'planta_id']);

        return $rules;
    }
}
