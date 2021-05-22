<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DataSheetsSeason Entity
 *
 * @property int $id
 * @property int $data_sheet_id
 * @property int $season_id
 *
 * @property \App\Model\Entity\DataSheet $data_sheet
 * @property \App\Model\Entity\Season $season
 */
class DataSheetsSeason extends Entity
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
        'data_sheet_id' => true,
        'season_id' => true,
        'data_sheet' => true,
        'season' => true,
    ];
}
