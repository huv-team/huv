<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Core\Configure;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\InternalErrorException;
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
        $this->viewBuilder()->setOption('serialize', ['plants']);
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
        $this->request->allowMethod(['get']);
        $plant = $this->Plants->get($id, [
            'contain' => 
                ['Families',
                 'Types'],
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

        $data = $this->request->getData();
        $this->loadModel("Families");
        $family = $this->Families->newEntity($data['family']);
        $result = $this->Families->find()->where([
            "or" => [
                "nombre_cientifico" => $family->nombre_cientifico,
                "and" => [
                    "nombre_cientifico IS" => null,
                    "nombre_popular" => $family->nombre_popular,
                ]

            ]
        ])->first();
        if( !empty($result) ) {
            unset($data['family']);
            $data['family_id'] = $result->id;
        }
        
        $plant = $this->Plants->newEntity($data, [
            'associated' => ['Families'],
        ]);
        if ($this->Plants->save($plant)) {
            $plant = $this->Plants->get($plant->id, [
                'contain' => ['Families'],
            ]);
            $this->set('plant', $plant);
            $this->viewBuilder()->setOption('serialize', ['plant']);
        }
        else {
            throw new BadRequestException(json_encode($plant->getErrors(), JSON_PRETTY_PRINT));
        }
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

        $plant = $this->Plants->patchEntity($plant, $this->request->getData());
        if ($this->Plants->save($plant)) {
            $this->set('plant', $plant);
            $this->viewBuilder()->setOption('serialize', ['plant']);
        }
        else {
            throw new BadRequestException(json_encode($plant->getErrors(), JSON_PRETTY_PRINT));
        }
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
        $this->request->allowMethod(['delete']);
        $plant = $this->Plants->get($id);
        if ($this->Plants->delete($plant)) {
            $this->viewBuilder()->setOption('serialize', []);
        } else {
            throw new InternalErrorException('No se puede borrar el recurso.');
        }

    }
}