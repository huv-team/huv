<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tip Entity
 *
 * @property int $id
 * @property string|null $contenido
 * @property int|null $fuente_id
 * @property string|null $titulo
 *
 * @property \App\Model\Entity\Source $source
 * @property \App\Model\Entity\DataSheet[] $data_sheets
 */
class Tip extends Entity
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
        'contenido' => true,
        'fuente_id' => true,
        'titulo' => true,
        'source' => true,
        'data_sheets' => true,
    ];
}
