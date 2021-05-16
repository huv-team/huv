<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasFamilium Entity
 *
 * @property int $id
 * @property string|null $nombre_popular
 * @property string|null $nombre_cientifico
 */
class PlantasFamilium extends Entity
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
    ];
}
