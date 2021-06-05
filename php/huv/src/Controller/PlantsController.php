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
        array_walk($plants, function ($plant) {
            unset($plant->family_id);
            unset($plant->type_id);
            $plant->data_sheet_id = !empty($plant->data_sheet) ? $plant->data_sheet->id : null;
            unset($plant->data_sheet);
        });
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
