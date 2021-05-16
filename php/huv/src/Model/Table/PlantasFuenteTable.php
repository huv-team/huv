<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlantasFuente Model
 *
 * @method \App\Model\Entity\PlantasFuente newEmptyEntity()
 * @method \App\Model\Entity\PlantasFuente newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFuente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFuente get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlantasFuente findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PlantasFuente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFuente[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlantasFuente|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFuente saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlantasFuente[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFuente[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFuente[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PlantasFuente[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlantasFuenteTable extends Table
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

        $this->setTable('plantas_fuente');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('otros')
            ->maxLength('otros', 4294967295)
            ->allowEmptyString('otros');

        $validator
            ->scalar('url')
            ->maxLength('url', 200)
            ->allowEmptyString('url');

        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 4294967295)
            ->allowEmptyString('titulo');

        $validator
            ->date('acceso')
            ->allowEmptyDate('acceso');

        $validator
            ->scalar('anio')
            ->maxLength('anio', 4294967295)
            ->allowEmptyString('anio');

        $validator
            ->scalar('nombre_revista')
            ->maxLength('nombre_revista', 4294967295)
            ->allowEmptyString('nombre_revista');

        $validator
            ->scalar('capitulo')
            ->maxLength('capitulo', 4294967295)
            ->allowEmptyString('capitulo');

        $validator
            ->scalar('contenido')
            ->maxLength('contenido', 4294967295)
            ->allowEmptyString('contenido');

        $validator
            ->integer('edicion')
            ->allowEmptyString('edicion');

        $validator
            ->scalar('editorial')
            ->maxLength('editorial', 4294967295)
            ->allowEmptyString('editorial');

        $validator
            ->scalar('nombre_pag')
            ->maxLength('nombre_pag', 4294967295)
            ->allowEmptyString('nombre_pag');

        $validator
            ->integer('numero')
            ->allowEmptyString('numero');

        $validator
            ->integer('pag_fin')
            ->allowEmptyString('pag_fin');

        $validator
            ->integer('pag_inicio')
            ->allowEmptyString('pag_inicio');

        $validator
            ->scalar('red_social')
            ->maxLength('red_social', 10)
            ->allowEmptyString('red_social');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->allowEmptyString('tipo');

        $validator
            ->scalar('tipo_cont')
            ->maxLength('tipo_cont', 4294967295)
            ->allowEmptyString('tipo_cont');

        $validator
            ->scalar('usuario')
            ->maxLength('usuario', 4294967295)
            ->allowEmptyString('usuario');

        $validator
            ->integer('volumen')
            ->allowEmptyString('volumen');

        return $validator;
    }
}
