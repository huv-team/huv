<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\BadRequestException;
use Cake\Log\Log;
use Cake\Validation\Validator;

/**
 * Plants Controller
 *
 * @property \App\Model\Table\PlantsTable $Plants
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlantsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {   
        $this->paginate = [
            'contain' => [
                "Families",
                "Types",
                "DataSheets"
            ],
        ];
        $plants = $this->paginate($this->Plants);
        $this->set('plants', $plants);
        $this->set('types', Configure::read('Constants.plantsTypes'));
    }


    /**
     * View method
     *
     * @param string|null $id Plants id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plant = $this->Plants->get($id, [
            'contain' => 
                ['Families',
                 'Types'],
        ]);

        $this->set('plant', $plant);
        $this->set('types', Configure::read('Constants.plantsTypes'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plant = $this->Plants->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());exit;
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());
            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The {0} has been saved.', $plant->nombre_popular));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add {0}.', $plant->nombre_popular));
        }
        $plantsFamilies = $this->Plants->Families->find('list', ['limit' => 200]);
        $_types_names = Configure::read('Constants.plantsTypes');
        $plantsTypes = array_map(
            fn($ty) => $_types_names[$ty],
            $this->Plants->Types->find('list', ['limit' => 200])->toArray(),
        );
        $this->set(compact('plant', 'plantsFamilies', 'plantsTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plants id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plant = $this->Plants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());
            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The {0} has been updated.', $plant->nombre_popular));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update {0}.', $plant->nombre_popular));
        }
        $plantsFamilies = $this->Plants->Families->find('list', ['limit' => 200]);
        $_types_names = Configure::read('Constants.plantsTypes');
        $plantsTypes = array_map(
            fn($ty) => $_types_names[$ty],
            $this->Plants->Types->find('list', ['limit' => 200])->toArray(),
        );
        $this->set(compact('plant', 'plantsFamilies', 'plantsTypes'));
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Planta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plant = $this->Plants->get($id);
        if ($this->Plants->delete($plant)) {
            $this->Flash->success(__('The {0} plant has been deleted.', $plant->nombre_popular));
        } else {
            $this->Flash->error(__('The {0} plant could not be deleted.', $plant->nombre_popular));
        }
        return $this->redirect(['action' => 'index']);
    }
}