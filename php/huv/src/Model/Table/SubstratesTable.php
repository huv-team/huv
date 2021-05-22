<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Substrates Model
 *
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsToMany $DataSheets
 *
 * @method \App\Model\Entity\Substrate newEmptyEntity()
 * @method \App\Model\Entity\Substrate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Substrate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Substrate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Substrate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Substrate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Substrate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Substrate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Substrate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Substrate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Substrate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Substrate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Substrate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SubstratesTable extends Table
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

        $this->setTable('substrates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('DataSheets', [
            'foreignKey' => 'substrate_id',
            'targetForeignKey' => 'data_sheet_id',
            'joinTable' => 'data_sheets_substrates',
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
            ->scalar('tierra')
            ->maxLength('tierra', 200)
            ->allowEmptyString('tierra');

        $validator
            ->boolean('potasio')
            ->requirePresence('potasio', 'create')
            ->notEmptyString('potasio');

        $validator
            ->boolean('nitrogeno')
            ->requirePresence('nitrogeno', 'create')
            ->notEmptyString('nitrogeno');

        $validator
            ->boolean('fosforo')
            ->requirePresence('fosforo', 'create')
            ->notEmptyString('fosforo');

        return $validator;
    }
}
