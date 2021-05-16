<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFichaSustrato Model
 *
 * @property \App\Model\Table\PlantasFichaTable&\Cake\ORM\Association\BelongsTo $PlantasFicha
 * @property \App\Model\Table\PlantasSustratoTable&\Cake\ORM\Association\BelongsTo $PlantasSustrato
 *
 * @method \App\Model\Entity\PlantasFichaSustrato newEmptyEntity()
 * @method \App\Model\Entity\PlantasFichaSustrato newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaSustrato[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFichaSustratoTable extends Table
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

        $this->setTable('plantas_ficha_sustrato');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFicha', [
            'foreignKey' => 'ficha_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlantasSustrato', [
            'foreignKey' => 'sustrato_id',
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
        $rules->add($rules->existsIn(['ficha_id'], 'PlantasFicha'), ['errorField' => 'ficha_id']);
        $rules->add($rules->existsIn(['sustrato_id'], 'PlantasSustrato'), ['errorField' => 'sustrato_id']);

        return $rules;
    }
}
