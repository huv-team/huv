<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasEpoca Model
 *
 * @method \App\Model\Entity\PlantasEpoca newEmptyEntity()
 * @method \App\Model\Entity\PlantasEpoca newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasEpoca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasEpoca get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasEpoca findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasEpoca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasEpoca[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasEpoca|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasEpoca saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasEpoca[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasEpoca[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasEpoca[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasEpoca[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasEpocaTable extends Table
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

        $this->setTable('plantas_epoca');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('desde_mes')
            ->maxLength('desde_mes', 20)
            ->requirePresence('desde_mes', 'create')
            ->notEmptyString('desde_mes');

        $validator
            ->scalar('hasta_mes')
            ->maxLength('hasta_mes', 20)
            ->requirePresence('hasta_mes', 'create')
            ->notEmptyString('hasta_mes');

        $validator
            ->integer('desde_dia')
            ->requirePresence('desde_dia', 'create')
            ->notEmptyString('desde_dia');

        $validator
            ->integer('hasta_dia')
            ->requirePresence('hasta_dia', 'create')
            ->notEmptyString('hasta_dia');

        return $validator;
    }
}
