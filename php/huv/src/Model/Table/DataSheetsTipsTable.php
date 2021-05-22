<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DataSheetsTips Model
 *
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsTo $DataSheets
 * @property \App\Model\Table\TipsTable&\Cake\ORM\Association\BelongsTo $Tips
 *
 * @method \App\Model\Entity\DataSheetsTip newEmptyEntity()
 * @method \App\Model\Entity\DataSheetsTip newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsTip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsTip get($primaryKey, $options = [])
 * @method \App\Model\Entity\DataSheetsTip findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DataSheetsTip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsTip[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheetsTip|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsTip saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheetsTip[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsTip[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsTip[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheetsTip[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DataSheetsTipsTable extends Table
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

        $this->setTable('data_sheets_tips');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DataSheets', [
            'foreignKey' => 'data_sheet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tips', [
            'foreignKey' => 'tip_id',
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
        $rules->add($rules->existsIn(['tip_id'], 'Tips'), ['errorField' => 'tip_id']);

        return $rules;
    }
}
