<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasRotacion Entity
 *
 * @property int $id
 * @property int|null $anterior_id
 * @property int|null $posterior_id
 * @property int|null $actual_id
 *
 * @property \App\Model\Entity\PlantasFamilium $plantas_familium
 */
class PlantasRotacion extends Entity
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
        'anterior_id' => true,
        'posterior_id' => true,
        'actual_id' => true,
        'plantas_familium' => true,
    ];
}
