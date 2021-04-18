<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasRotacion Model
 *
 * @property \App\Model\Table\PlantasFamiliaTable&\Cake\ORM\Association\BelongsTo $PlantasFamilia
 * @property \App\Model\Table\PlantasFamiliaTable&\Cake\ORM\Association\BelongsTo $PlantasFamilia
 * @property \App\Model\Table\PlantasFamiliaTable&\Cake\ORM\Association\BelongsTo $PlantasFamilia
 *
 * @method \App\Model\Entity\PlantasRotacion newEmptyEntity()
 * @method \App\Model\Entity\PlantasRotacion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasRotacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasRotacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasRotacion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasRotacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasRotacion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasRotacion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasRotacion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasRotacion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasRotacion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasRotacion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasRotacion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasRotacionTable extends Table
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

        $this->setTable('plantas_rotacion');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFamilia', [
            'foreignKey' => 'anterior_id',
        ]);
        $this->belongsTo('PlantasFamilia', [
            'foreignKey' => 'posterior_id',
        ]);
        $this->belongsTo('PlantasFamilia', [
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
        $rules->add($rules->existsIn(['anterior_id'], 'PlantasFamilia'), ['errorField' => 'anterior_id']);
        $rules->add($rules->existsIn(['posterior_id'], 'PlantasFamilia'), ['errorField' => 'posterior_id']);
        $rules->add($rules->existsIn(['actual_id'], 'PlantasFamilia'), ['errorField' => 'actual_id']);

        return $rules;
    }
}
