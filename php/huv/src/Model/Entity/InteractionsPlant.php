<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InteractionsPlant Entity
 *
 * @property int $id
 * @property int $interaction_id
 * @property int $plant_id
 * @property string|null $type
 *
 * @property \App\Model\Entity\Interaction $interaction
 * @property \App\Model\Entity\Plant $plant
 */
class InteractionsPlant extends Entity
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
        'interaction_id' => true,
        'plant_id' => true,
        'type' => true,
        'interaction' => true,
        'plant' => true,
    ];
}
