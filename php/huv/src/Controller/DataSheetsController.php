<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

/**
 * DataSheets Controller
 *
 * @property \App\Model\Table\DataSheetsTable $DataSheets
 * @method \App\Model\Entity\DataSheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DataSheetsController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Data Sheet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $data_sheet = $this->DataSheets->get($id, [
            'contain' => [
                'Plants' => [
                    'Families',
                    'Types'
                ],
                'Seasons', 'Sources', 'Substrates', 'Tips'],
        ]);
        
        $this->set(compact('data_sheet'));
        $this->set('types', Configure::read('Constants.plantsTypes'));
    }

}
