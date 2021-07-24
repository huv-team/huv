<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Seasons Model
 *
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsToMany $DataSheets
 *
 * @method \App\Model\Entity\Season newEmptyEntity()
 * @method \App\Model\Entity\Season newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Season[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Season get($primaryKey, $options = [])
 * @method \App\Model\Entity\Season findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Season patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Season[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Season|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Season saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Season[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Season[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Season[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Season[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SeasonsTable extends Table
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

        $this->setTable('seasons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('DataSheets', [
            'foreignKey' => 'season_id',
            'targetForeignKey' => 'data_sheet_id',
            'joinTable' => 'data_sheets_seasons',
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
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->integer('desde_mes')
            ->requirePresence('desde_mes', 'create')
            ->notEmptyString('desde_mes');

        $validator
            ->integer('hasta_mes')
            ->requirePresence('hasta_mes', 'create')
            ->notEmptyString('hasta_mes');

        $validator
            ->integer('desde_dia')
            ->requirePresence('desde_dia', 'create')
            ->notEmptyString('desde_dia');

        $validator
            ->integer('hasta_dia')
            ->requirePresence('hasta_dia', 'create')
            ->notEmptyString('hasta_dia');

        return $validator;
    }
}
