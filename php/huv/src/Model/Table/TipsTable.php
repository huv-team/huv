<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tips Model
 *
 * @property \App\Model\Table\SourcesTable&\Cake\ORM\Association\BelongsTo $Sources
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsToMany $DataSheets
 *
 * @method \App\Model\Entity\Tip newEmptyEntity()
 * @method \App\Model\Entity\Tip newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tip get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tip findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tip[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tip|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tip saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tip[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tip[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tip[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tip[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TipsTable extends Table
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

        $this->setTable('tips');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sources', [
            'foreignKey' => 'source_id',
        ]);
        $this->belongsToMany('DataSheets', [
            'foreignKey' => 'tip_id',
            'targetForeignKey' => 'data_sheet_id',
            'joinTable' => 'data_sheets_tips',
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
        $rules->add($rules->existsIn(['source_id'], 'Sources'), ['errorField' => 'source_id']);

        return $rules;
    }
}
