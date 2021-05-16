<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFichaFuentes Model
 *
 * @property \App\Model\Table\PlantasFichaTable&\Cake\ORM\Association\BelongsTo $PlantasFicha
 * @property \App\Model\Table\PlantasFuenteTable&\Cake\ORM\Association\BelongsTo $PlantasFuente
 *
 * @method \App\Model\Entity\PlantasFichaFuente newEmptyEntity()
 * @method \App\Model\Entity\PlantasFichaFuente newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFichaFuente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFichaFuentesTable extends Table
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

        $this->setTable('plantas_ficha_fuentes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlantasFicha', [
            'foreignKey' => 'ficha_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PlantasFuente', [
            'foreignKey' => 'fuente_id',
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
        $rules->add($rules->existsIn(['fuente_id'], 'PlantasFuente'), ['errorField' => 'fuente_id']);

        return $rules;
    }
}
