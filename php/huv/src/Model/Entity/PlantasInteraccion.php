<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasInteraccion Entity
 *
 * @property int $id
 * @property int|null $target_id
 * @property string|null $relacion
 * @property string $tipo
 *
 * @property \App\Model\Entity\PlantasPlantum $plantas_plantum
 */
class PlantasInteraccion extends Entity
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
        'target_id' => true,
        'relacion' => true,
        'tipo' => true,
        'plantas_plantum' => true,
    ];
}
