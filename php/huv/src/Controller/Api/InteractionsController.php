<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Core\Configure;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Log\Log;
use Cake\Validation\Validator;

/**
 * Interactions Controller
 *
 * @property \App\Model\Table\InteractionsTable $Interaction
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InteractionsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $interactions = $this->Interactions->find('all');
        $interactions ->contain([
            'Plants',
        ]);
        #debug($interactions);
        $this->set('interactions', $interactions);
        $this->viewBuilder()->setOption('serialize', ['interactions']);
    }

    public function view($id)
    {
        $family = $this->Families->get($id);
        $this->set('family', $family);
        $this->viewBuilder()->setOption('serialize', ['family']);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $family = $this->Families->newEntity($this->request->getData());

        $result = $this->Families->find()->where([
            "or" => [
                "nombre_cientifico" => $family->nombre_cientifico,
                "and" => [
                    "nombre_cientifico IS" => null,
                    "nombre_popular" => $family->nombre_popular,
                ]

            ]
        ])->first();
        if( empty($result) ) {
            if ($this->Families->save($family)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        else {
            $message = 'La familia ya existe';
            $family = $result;
        }
        
        $this->set([
            'message' => $message,
            'family' => $family,
        ]);
        $this->viewBuilder()->setOption('serialize', ['family', 'message']);

    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $family = $this->Families->get($id);
        $family = $this->Families->patchEntity($family, $this->request->getData());
        if ($this->Families->save($family)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'family' => $family,
        ]);
        $this->viewBuilder()->setOption('serialize', ['family', 'message']);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $family = $this->Families->get($id);
        $message = 'Deleted';
        if (!$this->Families->delete($family)) {
            $message = 'Error';
        }
        $this->set('message', $message);
        $this->viewBuilder()->setOption('serialize', ['message']);
    }
}