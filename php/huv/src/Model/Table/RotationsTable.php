<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rotations Model
 *
 * @property \App\Model\Table\FamiliesTable&\Cake\ORM\Association\BelongsTo $Families
 * @property \App\Model\Table\FamiliesTable&\Cake\ORM\Association\BelongsTo $Families
 * @property \App\Model\Table\FamiliesTable&\Cake\ORM\Association\BelongsTo $Families
 *
 * @method \App\Model\Entity\Rotation newEmptyEntity()
 * @method \App\Model\Entity\Rotation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rotation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rotation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rotation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rotation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rotation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rotation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rotation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rotation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rotation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rotation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rotation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RotationsTable extends Table
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

        $this->setTable('rotations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Families', [
            'foreignKey' => 'anterior_id',
        ]);
        $this->belongsTo('Families', [
            'foreignKey' => 'posterior_id',
        ]);
        $this->belongsTo('Families', [
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
        $rules->add($rules->existsIn(['anterior_id'], 'Families'), ['errorField' => 'anterior_id']);
        $rules->add($rules->existsIn(['posterior_id'], 'Families'), ['errorField' => 'posterior_id']);
        $rules->add($rules->existsIn(['actual_id'], 'Families'), ['errorField' => 'actual_id']);

        return $rules;
    }
}
