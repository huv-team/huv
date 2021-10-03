<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Core\Configure;

/**
 * Constants Controller
 *
 * @method \App\Model\Entity\Constant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConstantsController extends AppController
{
    /**
     * plantsTypes
     */
    public function getPlantsTypes()
    {
        $this->set('types', Configure::read('Constants.plantsTypes'));
        $this->viewBuilder()->setOption('serialize', ['types']);
    }

    /**
     * epochsTypes
     */
    public function getEpochsTypes()
    {
        $this->set('types', Configure::read('Constants.epochsTypes'));
        $this->viewBuilder()->setOption('serialize', ['types']);
    }
}
