<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interaction Entity
 *
 * @property int $id
 * @property string|null $description
 * @property string $type
 * @property int $plant_id
 *
 * @property \App\Model\Entity\Plant $target
 * @property \App\Model\Entity\Plant[] $actors
 */
class Interaction extends Entity
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
        'description' => true,
        'type' => true,
        'plant_id' => true,
        'target' => true,
        'actors' => true,
    ];
}
