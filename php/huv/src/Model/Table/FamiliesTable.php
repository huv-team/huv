<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Families Model
 *
 * @method \App\Model\Entity\Family newEmptyEntity()
 * @method \App\Model\Entity\Family newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Family[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Family get($primaryKey, $options = [])
 * @method \App\Model\Entity\Family findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Family patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Family[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Family|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Family saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Family[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Family[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Family[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Family[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FamiliesTable extends Table
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

        $this->setTable('families');
        $this->setDisplayField('nombre_popular');
        $this->setPrimaryKey('id');

        $this->hasMany('Plants', [
            'foreignKey' => 'family_id',
        ]);

        $this->hasMany('PreviousInRotations', [
            'className' => 'Rotations',
            'foreignKey' => 'anterior_id',
        ]);

        $this->hasMany('PosteriorInRotations', [
            'className' => 'Rotations',
            'foreignKey' => 'posterior_id',
        ]);

        $this->hasMany('CurrentInRotations', [
            'className' => 'Rotations',
            'foreignKey' => 'actual_id',
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
            ->allowEmptyString('nombre_popular');

        $validator
            ->scalar('nombre_cientifico')
            ->maxLength('nombre_cientifico', 200)
            ->requirePresence('nombre_cientifico', 'create')
            ->notEmptyString('nombre_cientifico');

        return $validator;
    }
}
