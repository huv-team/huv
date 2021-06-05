<?php
declare(strict_types=1);

namespace App\Controller;

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
        $this->loadComponent('Flash'); // Include the FlashComponent
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
        $plants = $this->paginate($this->Plants)->toArray();
        $this->set('plants', $plants);
        $this->viewBuilder()->setOption('serialize', ['plants']);
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
        $Plant = $this->plants->get($id, [
            'contain' => 
                ['Families',
                 'Types'],
        ]);

        $this->set(compact('Plant'));
    }
}
