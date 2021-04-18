<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFamilia Model
 *
 * @method \App\Model\Entity\PlantasFamilium newEmptyEntity()
 * @method \App\Model\Entity\PlantasFamilium newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFamilium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFamilium get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFamilium findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFamilium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFamilium[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFamilium|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFamilium saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFamilium[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFamilium[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFamilium[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFamilium[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFamiliaTable extends Table
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

        $this->setTable('plantas_familia');
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
            ->scalar('nombre_popular')
            ->maxLength('nombre_popular', 200)
            ->allowEmptyString('nombre_popular');

        $validator
            ->scalar('nombre_cientifico')
            ->maxLength('nombre_cientifico', 200)
            ->allowEmptyString('nombre_cientifico');

        return $validator;
    }
}
