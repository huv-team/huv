<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasPlanta Model
 *
 * @property \App\Model\Table\PlantasFamiliaTable&\Cake\ORM\Association\BelongsTo $PlantasFamilia
 * @property \App\Model\Table\PlantasTipoTable&\Cake\ORM\Association\BelongsTo $PlantasTipo
 *
 * @method \App\Model\Entity\PlantasPlantum newEmptyEntity()
 * @method \App\Model\Entity\PlantasPlantum newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasPlantum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasPlantum get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasPlantum findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasPlantum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasPlantum[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasPlantum|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasPlantum saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasPlantum[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasPlantum[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasPlantum[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasPlantum[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasPlantaTable extends Table
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

        $this->setTable('plantas_planta');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFamilia', [
            'foreignKey' => 'familia_id',
        ]);
        $this->belongsTo('PlantasTipo', [
            'foreignKey' => 'tipo_id',
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
            ->scalar('nombre_popular')
            ->maxLength('nombre_popular', 200)
            ->requirePresence('nombre_popular', 'create')
            ->notEmptyString('nombre_popular');

        $validator
            ->scalar('nombre_cientifico')
            ->maxLength('nombre_cientifico', 200)
            ->allowEmptyString('nombre_cientifico');

        $validator
            ->scalar('variedad')
            ->maxLength('variedad', 200)
            ->allowEmptyString('variedad');

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
        $rules->add($rules->existsIn(['familia_id'], 'PlantasFamilia'), ['errorField' => 'familia_id']);
        $rules->add($rules->existsIn(['tipo_id'], 'PlantasTipo'), ['errorField' => 'tipo_id']);

        return $rules;
    }
}
