<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasAutor Entity
 *
 * @property int $id
 * @property string|null $apellido
 * @property string|null $primer_nombre
 * @property string|null $segundo_nombre
 */
class PlantasAutor extends Entity
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
        'apellido' => true,
        'primer_nombre' => true,
        'segundo_nombre' => true,
    ];
}
