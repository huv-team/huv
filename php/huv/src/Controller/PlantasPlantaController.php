<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PlantasPlanta Controller
 *
 * @property \App\Model\Table\PlantasPlantaTable $PlantasPlanta
 * @method \App\Model\Entity\PlantasPlantum[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlantasPlantaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PlantasFamilia', 'PlantasTipo'],
        ];
        $plantasPlanta = $this->paginate($this->PlantasPlanta);

        $this->set(compact('plantasPlanta'));
    }

    /**
     * View method
     *
     * @param string|null $id Plantas Plantum id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plantasPlantum = $this->PlantasPlanta->get($id, [
            'contain' => ['PlantasFamilia', 'PlantasTipo'],
        ]);

        $this->set(compact('plantasPlantum'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plantasPlantum = $this->PlantasPlanta->newEmptyEntity();
        if ($this->request->is('post')) {
            $plantasPlantum = $this->PlantasPlanta->patchEntity($plantasPlantum, $this->request->getData());
            if ($this->PlantasPlanta->save($plantasPlantum)) {
                $this->Flash->success(__('The plantas plantum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plantas plantum could not be saved. Please, try again.'));
        }
        $plantasFamilia = $this->PlantasPlanta->PlantasFamilia->find('list', ['limit' => 200]);
        $plantasTipo = $this->PlantasPlanta->PlantasTipo->find('list', ['limit' => 200]);
        $this->set(compact('plantasPlantum', 'plantasFamilia', 'plantasTipo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plantas Plantum id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plantasPlantum = $this->PlantasPlanta->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plantasPlantum = $this->PlantasPlanta->patchEntity($plantasPlantum, $this->request->getData());
            if ($this->PlantasPlanta->save($plantasPlantum)) {
                $this->Flash->success(__('The plantas plantum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plantas plantum could not be saved. Please, try again.'));
        }
        $plantasFamilia = $this->PlantasPlanta->PlantasFamilia->find('list', ['limit' => 200]);
        $plantasTipo = $this->PlantasPlanta->PlantasTipo->find('list', ['limit' => 200]);
        $this->set(compact('plantasPlantum', 'plantasFamilia', 'plantasTipo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plantas Plantum id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plantasPlantum = $this->PlantasPlanta->get($id);
        if ($this->PlantasPlanta->delete($plantasPlantum)) {
            $this->Flash->success(__('The plantas plantum has been deleted.'));
        } else {
            $this->Flash->error(__('The plantas plantum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
