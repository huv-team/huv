<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasTip Model
 *
 * @property \App\Model\Table\PlantasFuenteTable&\Cake\ORM\Association\BelongsTo $PlantasFuente
 *
 * @method \App\Model\Entity\PlantasTip newEmptyEntity()
 * @method \App\Model\Entity\PlantasTip newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasTip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasTip get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasTip findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasTip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasTip[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasTip|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasTip saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasTip[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasTip[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasTip[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasTip[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasTipTable extends Table
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

        $this->setTable('plantas_tip');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFuente', [
            'foreignKey' => 'fuente_id',
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
            ->scalar('contenido')
            ->maxLength('contenido', 4294967295)
            ->allowEmptyString('contenido');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 200)
            ->allowEmptyString('titulo');

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
        $rules->add($rules->existsIn(['fuente_id'], 'PlantasFuente'), ['errorField' => 'fuente_id']);

        return $rules;
    }
}
