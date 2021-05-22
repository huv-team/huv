<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DataSheets Model
 *
 * @property \App\Model\Table\PlantsTable&\Cake\ORM\Association\BelongsTo $Plants
 * @property \App\Model\Table\SeasonsTable&\Cake\ORM\Association\BelongsToMany $Seasons
 * @property \App\Model\Table\SourcesTable&\Cake\ORM\Association\BelongsToMany $Sources
 * @property \App\Model\Table\SubstratesTable&\Cake\ORM\Association\BelongsToMany $Substrates
 * @property \App\Model\Table\TipsTable&\Cake\ORM\Association\BelongsToMany $Tips
 *
 * @method \App\Model\Entity\DataSheet newEmptyEntity()
 * @method \App\Model\Entity\DataSheet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DataSheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\DataSheet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DataSheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DataSheet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DataSheet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DataSheet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DataSheetsTable extends Table
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

        $this->setTable('data_sheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Plants', [
            'foreignKey' => 'planta_id',
        ]);
        $this->belongsToMany('Seasons', [
            'foreignKey' => 'data_sheet_id',
            'targetForeignKey' => 'season_id',
            'joinTable' => 'data_sheets_seasons',
        ]);
        $this->belongsToMany('Sources', [
            'foreignKey' => 'data_sheet_id',
            'targetForeignKey' => 'source_id',
            'joinTable' => 'data_sheets_sources',
        ]);
        $this->belongsToMany('Substrates', [
            'foreignKey' => 'data_sheet_id',
            'targetForeignKey' => 'substrate_id',
            'joinTable' => 'data_sheets_substrates',
        ]);
        $this->belongsToMany('Tips', [
            'foreignKey' => 'data_sheet_id',
            'targetForeignKey' => 'tip_id',
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
            ->integer('volumen_maceta_ltr')
            ->allowEmptyString('volumen_maceta_ltr');

        $validator
            ->integer('profundidad_cm')
            ->allowEmptyString('profundidad_cm');

        $validator
            ->scalar('tamano')
            ->maxLength('tamano', 200)
            ->allowEmptyString('tamano');

        $validator
            ->integer('horas_sol_min')
            ->allowEmptyString('horas_sol_min');

        $validator
            ->integer('horas_sol_max')
            ->allowEmptyString('horas_sol_max');

        $validator
            ->scalar('riego')
            ->maxLength('riego', 200)
            ->allowEmptyString('riego');

        $validator
            ->boolean('tutorado')
            ->requirePresence('tutorado', 'create')
            ->notEmptyString('tutorado');

        $validator
            ->integer('distancia_max_cm')
            ->allowEmptyString('distancia_max_cm');

        $validator
            ->integer('temperatura_max')
            ->allowEmptyString('temperatura_max');

        $validator
            ->integer('temperatura_min')
            ->allowEmptyString('temperatura_min');

        $validator
            ->boolean('tolera_sombra')
            ->requirePresence('tolera_sombra', 'create')
            ->notEmptyString('tolera_sombra');

        $validator
            ->integer('distancia_min_cm')
            ->allowEmptyString('distancia_min_cm');

        $validator
            ->integer('tiempo_cultivo_min_dias')
            ->allowEmptyString('tiempo_cultivo_min_dias');

        $validator
            ->integer('tiempo_cultivo_max_dias')
            ->allowEmptyString('tiempo_cultivo_max_dias');

        $validator
            ->scalar('fecundacion')
            ->maxLength('fecundacion', 20)
            ->allowEmptyString('fecundacion');

        $validator
            ->boolean('aporque')
            ->requirePresence('aporque', 'create')
            ->notEmptyString('aporque');

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
        $rules->add($rules->existsIn(['planta_id'], 'Plants'), ['errorField' => 'planta_id']);

        return $rules;
    }
}
