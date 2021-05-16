<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasAutororder Entity
 *
 * @property int $id
 * @property int $number
 * @property int|null $autor_id
 *
 * @property \App\Model\Entity\Autor $autor
 */
class PlantasAutororder extends Entity
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
        'number' => true,
        'autor_id' => true,
        'autor' => true,
    ];
}
