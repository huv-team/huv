<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sources Model
 *
 * @property \App\Model\Table\AuthorsTable&\Cake\ORM\Association\BelongsToMany $Authors
 * @property \App\Model\Table\DataSheetsTable&\Cake\ORM\Association\BelongsToMany $DataSheets
 *
 * @method \App\Model\Entity\Source newEmptyEntity()
 * @method \App\Model\Entity\Source newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Source[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Source get($primaryKey, $options = [])
 * @method \App\Model\Entity\Source findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Source patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Source[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Source|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Source saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Source[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Source[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Source[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Source[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SourcesTable extends Table
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

        $this->setTable('sources');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Tips', [
            'foreignKey' => 'source_id',
        ]);
        $this->belongsToMany('Authors', [
            'foreignKey' => 'source_id',
            'targetForeignKey' => 'author_id',
            'joinTable' => 'authors_sources',
        ]);
        $this->belongsToMany('DataSheets', [
            'foreignKey' => 'source_id',
            'targetForeignKey' => 'data_sheet_id',
            'joinTable' => 'data_sheets_sources',
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
