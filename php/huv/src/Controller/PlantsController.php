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
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        $epochs_types = Configure::read('Constants.epochsTypes');
        $plants_types = Configure::read('Constants.plantsTypes');

        $validator = new Validator();

        $validator->add('actividad', 'inList', [
            'rule' => ['inList', array_keys($epochs_types)],
            'message' => "Elija un tipo de estos: ".json_encode($epochs_types)
        ]);

        $validator->add('tipo', 'inList', [
            'rule' => ['inList', array_keys($plants_types)],
            'message' => "Elija un tipo de estos: ".json_encode($plants_types)
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
                        return "Mes tiene que ser un entero en el rango [1;12]";
                    }
                }
            },
        ]);

        $errors = $validator->validate($data);
        if (!empty($errors)) {
            throw new BadRequestException(json_encode($errors,JSON_PRETTY_PRINT));
        }

        $conditions = [];
        
        if( isset($data['name']) ){
            $conditions[] = [
                "or" => [
                    "Plants.nombre_popular LIKE" => "%{$data['name']}%",
                    "Plants.nombre_cientifico LIKE" => "%{$data['name']}%",
                    "Families.nombre_popular LIKE" => "%{$data['name']}%",
                    "Families.nombre_cientifico LIKE" => "%{$data['name']}%",
                ]
            ];
        }
        
        if( isset($data['tipo']) ){
            $conditions[] = [
                "Types.nombre" => $data['tipo'],
            ];
        }

        if( isset($data['meses']) ){
            $conditions[] = [
                'or' => array_map(
                    function ($mes) use ($data) {
                        return [
                            "Seasons.tipo" => $data['actividad'],
                            "or" => [
                                "Seasons.desde_mes <=" => $mes,
                                "Seasons.hasta_mes >=" => $mes,
                            ]
                        ];
                    },
                    $data['meses']
                )
            ];
        }

        if( isset($data['macetas']) ){
            $conditions[] = [
                'or' => array_map(
                    function ($maceta) use ($data) {
                        return [
                            'or' => [
                                "DataSheets.volumen_maceta_ltr <=" => $maceta['volumen'],
                                "DataSheets.volumen_maceta_ltr IS" => null,
                            ],
                            'or' => [
                                "DataSheets.profundidad_cm <=" => $maceta['profundidad'],
                                "DataSheets.profundidad_cm IS" => null,
                            ],
                        ];
                    },
                    $data['macetas']
                )
            ];
        }
        
        $plants = $this->Plants->find('all', [
            'contain' => [
                "Families",
                "Types",
                "DataSheets.Seasons"
            ],
            'conditions' => $conditions,
        ])->leftJoinWith("DataSheets.Seasons");
        
        $plants = $this->paginate($plants);
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
            debug($this->request->getData());exit;
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());
            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('The {0} has been saved.', $plant->nombre_popular));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add {0}.', $plant->nombre_popular));
        }
        $plantFamily = $this->Plants->Families->find('list', ['limit' => 200]);
        $_type_names = Configure::read('Constants.plantsTypes');
        $plantType = array_map(
            fn($ty) => $_type_names[$ty],
            $this->Plants->Types->find('list', ['limit' => 200])->toArray(),
        );
        $this->set(compact('plant', 'plantFamily', 'plantType'));
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
        $plantFamily = $this->Plants->Families->find('list', ['limit' => 200]);
        $plantType = $this->Plants->Types->find('list', ['limit' => 200]);
        $this->set(compact('plant', 'plantFamily', 'plantType'));
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