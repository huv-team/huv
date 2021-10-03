<?php
declare(strict_types=1);

namespace App\Controller\Api;

/**
 * Dynamics Controller
 *
 * @method \App\Model\Entity\Dynamic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DynamicsController extends AppController
{
    /**
     * getPotsSize
     * busca las dimenciones de macetas en la BD
     * y devuelve una lista de opciones
     */
    public function getPotsSize()
    {
        $this->loadModel("DataSheets");
        $data_sheets = $this->DataSheets->find('all');
        $pots_sizes = array_map(
            function ($data_sheet) {
                return [
                    'volumene' => $data_sheet->volumen_maceta_ltr,
                    'profundidad' => $data_sheet->profundidad_cm,
                ];
            },
            $data_sheets->toArray()
        );

        $pots_sizes = [
            'volumenes' => array_values(array_unique(array_filter(array_column($pots_sizes, 'volumene'), function ($el) { return !empty($el); }))),
            'profundidades' => array_values(array_unique(array_filter(array_column($pots_sizes, 'profundidad'), function ($el) { return !empty($el); }))),
        ];

        $this->set('pots_sizes', $pots_sizes);
        $this->viewBuilder()->setOption('serialize', ['pots_sizes']);
    }
}
