<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasPlantum Entity
 *
 * @property int $id
 * @property string $nombre_popular
 * @property string|null $nombre_cientifico
 * @property int|null $familia_id
 * @property string|null $variedad
 * @property int|null $tipo_id
 *
 * @property \App\Model\Entity\PlantasFamilium $plantas_familium
 * @property \App\Model\Entity\PlantasTipo $plantas_tipo
 */
class PlantasPlantum extends Entity
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
        'nombre_popular' => true,
        'nombre_cientifico' => true,
        'familia_id' => true,
        'variedad' => true,
        'tipo_id' => true,
        'plantas_familium' => true,
        'plantas_tipo' => true,
    ];
}
