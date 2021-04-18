<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasAutororden Model
 *
 * @property \App\Model\Table\PlantasAutorTable&\Cake\ORM\Association\BelongsTo $PlantasAutor
 * @property \App\Model\Table\PlantasFuenteTable&\Cake\ORM\Association\BelongsTo $PlantasFuente
 *
 * @method \App\Model\Entity\PlantasAutororden newEmptyEntity()
 * @method \App\Model\Entity\PlantasAutororden newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororden[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororden get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasAutororden findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasAutororden patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororden[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasAutororden|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutororden saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasAutororden[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororden[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororden[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasAutororden[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasAutorordenTable extends Table
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

        $this->setTable('plantas_autororden');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasAutor', [
            'foreignKey' => 'autor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlantasFuente', [
            'foreignKey' => 'fuente_id',
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

        $validator
            ->integer('orden')
            ->requirePresence('orden', 'create')
            ->notEmptyString('orden');

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
        $rules->add($rules->existsIn(['autor_id'], 'PlantasAutor'), ['errorField' => 'autor_id']);
        $rules->add($rules->existsIn(['fuente_id'], 'PlantasFuente'), ['errorField' => 'fuente_id']);

        return $rules;
    }
}
