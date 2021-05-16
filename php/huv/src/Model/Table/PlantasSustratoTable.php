<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasSustrato Model
 *
 * @method \App\Model\Entity\PlantasSustrato newEmptyEntity()
 * @method \App\Model\Entity\PlantasSustrato newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasSustrato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasSustrato get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasSustrato findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasSustrato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasSustrato[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasSustrato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasSustrato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasSustrato[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasSustrato[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasSustrato[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasSustrato[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasSustratoTable extends Table
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

        $this->setTable('plantas_sustrato');
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
            ->scalar('tierra')
            ->maxLength('tierra', 200)
            ->allowEmptyString('tierra');

        $validator
            ->boolean('potasio')
            ->requirePresence('potasio', 'create')
            ->notEmptyString('potasio');

        $validator
            ->boolean('nitrogeno')
            ->requirePresence('nitrogeno', 'create')
            ->notEmptyString('nitrogeno');

        $validator
            ->boolean('fosforo')
            ->requirePresence('fosforo', 'create')
            ->notEmptyString('fosforo');

        return $validator;
    }
}
