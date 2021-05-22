<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plant Entity
 *
 * @property int $id
 * @property string $nombre_popular
 * @property string|null $nombre_cientifico
 * @property int|null $family_id
 * @property string|null $variedad
 * @property int|null $type_id
 *
 * @property \App\Model\Entity\Family $family
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\DataSheet $data_sheet
 * @property \App\Model\Entity\Interaction[] $interactions
 */
class Plant extends Entity
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
        'family_id' => true,
        'variedad' => true,
        'type_id' => true,
        'family' => true,
        'type' => true,
        'data_sheet' => true,
        'interactions' => true,
    ];
}
