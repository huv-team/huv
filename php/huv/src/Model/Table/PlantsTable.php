<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plants Model
 *
 * @property \App\Model\Table\FamiliesTable&\Cake\ORM\Association\BelongsTo $Families
 * @property \App\Model\Table\TypesTable&\Cake\ORM\Association\BelongsTo $Types
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\HasMany $DataSheets
 * @property \App\Model\Table\InteractionsTable&\Cake\ORM\Association\BelongsToMany $Interactions
 *
 * @method \App\Model\Entity\Plant newEmptyEntity()
 * @method \App\Model\Entity\Plant newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Plant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Plant findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Plant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Plant[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantsTable extends Table
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

        $this->setTable('plants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Families', [
            'foreignKey' => 'family_id',
        ]);
        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
        ]);
        $this->hasOne('DataSheets', [
            'foreignKey' => 'plant_id',
        ]);
        $this->belongsToMany('Interactions', [
            'foreignKey' => 'plant_id',
            'targetForeignKey' => 'interaction_id',
            'joinTable' => 'interactions_plants',
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
            ->requirePresence('nombre_popular', 'create')
            ->notEmptyString('nombre_popular');

        $validator
            ->scalar('nombre_cientifico')
            ->maxLength('nombre_cientifico', 200)
            ->allowEmptyString('nombre_cientifico');

        $validator
            ->scalar('variedad')
            ->maxLength('variedad', 200)
            ->allowEmptyString('variedad');

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
        $rules->add($rules->existsIn(['family_id'], 'Families'), ['errorField' => 'family_id']);
        $rules->add($rules->existsIn(['type_id'], 'Types'), ['errorField' => 'type_id']);

        return $rules;
    }
}
