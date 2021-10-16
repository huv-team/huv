<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Core\Configure;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Log\Log;
use Cake\Validation\Validator;

/**
 * Family Controller
 *
 * @property \App\Model\Table\FamiliesTable $Families
 * @method \App\Model\Entity\Plant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FamiliesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $families = $this->Families->find('all')->all();
        $this->set('families', $families);
        $this->viewBuilder()->setOption('serialize', ['families']);
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