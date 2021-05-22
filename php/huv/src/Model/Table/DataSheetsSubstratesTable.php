<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DataSheetsSubstrates Model
 *
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsTo $DataSheets
 * @property \App\Model\Table\SubstratesTable&\Cake\ORM\Association\BelongsTo $Substrates
 *
 * @method \App\Model\Entity\DataSheetsSubstrate newEmptyEntity()
 * @method \App\Model\Entity\DataSheetsSubstrate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate get($primaryKey, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSubstrate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DataSheetsSubstratesTable extends Table
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

        $this->setTable('data_sheets_substrates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DataSheets', [
            'foreignKey' => 'data_sheet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Substrates', [
            'foreignKey' => 'substrate_id',
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
        $rules->add($rules->existsIn(['data_sheet_id'], 'DataSheets'), ['errorField' => 'data_sheet_id']);
        $rules->add($rules->existsIn(['substrate_id'], 'Substrates'), ['errorField' => 'substrate_id']);

        return $rules;
    }
}
