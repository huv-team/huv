<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasSustrato Entity
 *
 * @property int $id
 * @property string|null $tierra
 * @property bool $potasio
 * @property bool $nitrogeno
 * @property bool $fosforo
 */
class PlantasSustrato extends Entity
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
        'tierra' => true,
        'potasio' => true,
        'nitrogeno' => true,
        'fosforo' => true,
    ];
}
