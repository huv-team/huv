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
        //$query = $this->request->getQuery();
        //if( !isset($query['nombre_popular']) ) {
        //    $conditions['Plants.nombre_popular'] = $query['nombre_popular'];
        //}
        //if( !isset($query['nombre_cientifico']) ) {
        //    $conditions['Plants.nombre_popular'] = $query['nombre_cientifico'];
        //}
        //if( !isset($query['type']) ) {}
        //if( !isset($query['family']) ) {}

        $this->paginate = [
            'contain' => [
                "Families",
                "Types",
                "DataSheets"
            ],
        ];
        $plants = $this->Paginator->paginate($this->Plants->find());
        $this->set(compact('plants'));
    }

    /**
     * Search method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function search()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        $_types = Configure::read('Constants.plantsTypes');

        $validator = new Validator();
        $validator->add('tipo', 'inList', [
            'rule' => ['inList', array_keys($_types)],
            'message' => "Elija un tipo de estos: ".json_encode($_types)
        ]);
        $validator->add('macetas', 'isArray', [
            'rule' => ['isArray'],
            'message' => "Macetas tiene que ser una lista"
        ]);
        $validator->add('meses', 'isArray', [
            'rule' => ['isArray'],
            'message' => "Meses tiene que ser una lista"
        ]);

        $pots_validator = new Validator();
        $pots_validator->scalar('volumen')->requirePresence('volumen');
        $pots_validator->scalar('profundidad')->requirePresence('profundidad');

        $validator->add('macetas', 'custom', [
            'rule' => function ($values, $context) use ($pots_validator) {
                if( empty($values) ) {
                    return "No hay macetas en la lista";
                }
                else {
                    if (array_reduce(
                        $values,
                        function ($res,$pot) use ($pots_validator) {
                            if( is_array($pot) ) {
                                $pots_errors = $pots_validator->validate($pot);
                                return $res && empty($pots_errors);
                            }
                            else {
                                return false;
                            }
                        },
                        true
                    )){
                        return true;
                    }
                    else {
                        return "Cada maceta debe respetar el formato {volumen:number;profundidad:number}";
                    }
                }
            },
        ]);

        $validator->add('meses', 'custom', [
            'rule' => function ($values, $context) {
                if( empty($values) ) {
                    return "No hay meses en la lista";
                }
                else {
                    if (array_reduce(
                        $values,
                        function ($res,$mes) {
                            return $res && in_array($mes, [1,2,3,4,5,6,7,8,9,10,11,12]);
                        },
                        true
                    )){
                        return true;
                    }
                    else {
                        return "Mes tiene que ser un entero en el rango [1,12]";
                    }
                }
            },
        ]);
        
        $errors = $validator->validate($data);
        if (!empty($errors)) {
            throw new BadRequestException(json_encode($errors,JSON_PRETTY_PRINT));
        }
        exit;
        
        $joins = [];
        if( isset($data['type']) ){ $joins[] = "Types"; }
        if( isset($data['pots']) ){ $joins[] = "DataSheets"; }
        if( isset($data['seasons']) ){ $joins[] = "DataSheets.Seasons"; }
        
        $conditions = [];
        if( isset($data['type']) ){ $conditions["Types.nombre"] = $data['type']; }
        if( isset($data['seasons']) ){ $conditions[] = "DataSheets.Seasons"; }
        if( isset($data['pots']) ){ $conditions[] = "DataSheets"; }
        
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

        $this->set(compact('plant'));
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