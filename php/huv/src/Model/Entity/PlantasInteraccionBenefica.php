<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasInteraccionBenefica Entity
 *
 * @property int $id
 * @property int $interaccion_id
 * @property int $planta_id
 *
 * @property \App\Model\Entity\PlantasInteraccion $plantas_interaccion
 * @property \App\Model\Entity\PlantasPlantum $plantas_plantum
 */
class PlantasInteraccionBenefica extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'interaccion_id' => true,
        'planta_id' => true,
        'plantas_interaccion' => true,
        'plantas_plantum' => true,
    ];
}
