<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlantasAutororden Entity
 *
 * @property int $id
 * @property int $orden
 * @property int $autor_id
 * @property int $fuente_id
 *
 * @property \App\Model\Entity\PlantasAutor $plantas_autor
 * @property \App\Model\Entity\PlantasFuente $plantas_fuente
 */
class PlantasAutororden extends Entity
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
        'orden' => true,
        'autor_id' => true,
        'fuente_id' => true,
        'plantas_autor' => true,
        'plantas_fuente' => true,
    ];
}
