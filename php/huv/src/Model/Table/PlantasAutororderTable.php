<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasAutororder Model
 *
 * @property \App\Model\Table\AutorsTable&\Cake\ORM\Association\BelongsTo $Autors
 *
 * @method \App\Model\Entity\PlantasAutororder newEmptyEntity()
 * @method \App\Model\Entity\PlantasAutororder newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororder get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasAutororder findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasAutororder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororder[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutororder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutororder[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororder[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororder[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororder[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasAutororderTable extends Table
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

        $this->setTable('plantas_autororder');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Autors', [
            'foreignKey' => 'autor_id',
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
            ->nonNegativeInteger('number')
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

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
        $rules->add($rules->existsIn(['autor_id'], 'Autors'), ['errorField' => 'autor_id']);

        return $rules;
    }
}
