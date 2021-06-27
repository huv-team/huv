<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

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

        $this->loadComponent('Paginator');
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
     * Search method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function search()
    {
        $conditions = [];
        $joins = [];
        
        $query = $this->request->getQuery();
        if( !isset($query['nombre_popular']) ) {
            $conditions['Plants.nombre_popular'] = $query['nombre_popular'];
        }
        if( !isset($query['nombre_cientifico']) ) {
            $conditions['Plants.nombre_popular'] = $query['nombre_cientifico'];
        }
        if( !isset($query['type']) ) {}
        if( !isset($query['family']) ) {}


        
        $this->paginate = [
            'contain' => [
                "Families",
                "Types",
                "DataSheets"
            ],
        ];
        $plants = $this->paginate($this->Plants)->toArray();
        $this->set('plants', $plants);
        $this->viewBuilder()->setOption('serialize', ['plants']);
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
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());
            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The plant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the plant.'));
        }
        $plantFamily = $this->Plants->Families->find('list', ['limit' => 200]);
        $plantType = $this->Plants->Types->find('list', ['limit' => 200]);
        $this->set(compact('plant', 'plantFamily', 'plantType'));
    }

}