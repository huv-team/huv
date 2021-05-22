<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Types Controller
 *
 * @property \App\Model\Table\TypesTable $Types
 * @method \App\Model\Entity\Type[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $types = $this->paginate($this->Types);

        $this->set(compact('types'));
        $this->viewBuilder()->setOption('serialize', ['types']);
    }
}
