<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DataSheetsSeasons Model
 *
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsTo $DataSheets
 * @property \App\Model\Table\SeasonsTable&\Cake\ORM\Association\BelongsTo $Seasons
 *
 * @method \App\Model\Entity\DataSheetsSeason newEmptyEntity()
 * @method \App\Model\Entity\DataSheetsSeason newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSeason get($primaryKey, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsSeason|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsSeason[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DataSheetsSeasonsTable extends Table
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

        $this->setTable('data_sheets_seasons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DataSheets', [
            'foreignKey' => 'data_sheet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Seasons', [
            'foreignKey' => 'season_id',
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
        $rules->add($rules->existsIn(['season_id'], 'Seasons'), ['errorField' => 'season_id']);

        return $rules;
    }
}
