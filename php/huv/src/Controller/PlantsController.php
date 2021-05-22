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
        $this->viewBuilder()->setOption('serialize', ['plants']);
    }

    /**
     * View method
     *
     * @param string|null $id Plant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plant = $this->Plants->get($id, [
            'contain' => [],
        ]);

        $this->set('plant', $plant);
        $this->viewBuilder()->setOption('serialize', ['plant']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $plant = $this->Plants->newEntity($this->request->getData());
        if ($this->Plants->save($plant)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'plant' => $plant,
        ]);
        $this->viewBuilder()->setOption('serialize', []);
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Plant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'put']);
        $plant = $this->Plants->get($id);
        $plant = $this->Plants->patchEntity($plant, $this->request->getData());
        if ($this->Plants->save($plant)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'plant' => $plant,
        ]);
        $this->viewBuilder()->setOption('serialize', ['plant', 'message']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Plant id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $plant = $this->Plants->get($id);
        $message = 'Deleted';
        if (!$this->Plants->delete($plant)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);

    }
}
