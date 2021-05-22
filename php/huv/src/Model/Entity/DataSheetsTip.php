<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DataSheetsTip Entity
 *
 * @property int $id
 * @property int $ficha_id
 * @property int $tip_id
 *
 * @property \App\Model\Entity\DataSheet $data_sheet
 * @property \App\Model\Entity\Tip $tip
 */
class DataSheetsTip extends Entity
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
        'ficha_id' => true,
        'tip_id' => true,
        'data_sheet' => true,
        'tip' => true,
    ];
}
