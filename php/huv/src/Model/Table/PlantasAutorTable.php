<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasAutor Model
 *
 * @method \App\Model\Entity\PlantasAutor newEmptyEntity()
 * @method \App\Model\Entity\PlantasAutor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutor get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasAutor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasAutor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasAutorTable extends Table
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

        $this->setTable('plantas_autor');
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
            ->scalar('apellido')
            ->maxLength('apellido', 200)
            ->allowEmptyString('apellido');

        $validator
            ->scalar('primer_nombre')
            ->maxLength('primer_nombre', 200)
            ->allowEmptyString('primer_nombre');

        $validator
            ->scalar('segundo_nombre')
            ->maxLength('segundo_nombre', 200)
            ->allowEmptyString('segundo_nombre');

        return $validator;
    }
}
