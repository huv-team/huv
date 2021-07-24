<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Season Entity
 *
 * @property int $id
 * @property string $tipo
 * @property int $desde_mes
 * @property int $hasta_mes
 * @property int $desde_dia
 * @property int $hasta_dia
 *
 * @property \App\Model\Entity\DataSheet[] $data_sheets
 */
class Season extends Entity
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
        'tipo' => true,
        'desde_mes' => true,
        'hasta_mes' => true,
        'desde_dia' => true,
        'hasta_dia' => true,
        'data_sheets' => true,
    ];
}
