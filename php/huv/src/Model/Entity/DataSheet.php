<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DataSheet Entity
 *
 * @property int $id
 * @property int|null $volumen_maceta_ltr
 * @property int|null $profundidad_cm
 * @property string|null $tamano
 * @property int|null $horas_sol_min
 * @property int|null $horas_sol_max
 * @property string|null $riego
 * @property bool $tutorado
 * @property int|null $planta_id
 * @property int|null $distancia_max_cm
 * @property int|null $temperatura_max
 * @property int|null $temperatura_min
 * @property bool $tolera_sombra
 * @property int|null $distancia_min_cm
 * @property int|null $tiempo_cultivo_min_dias
 * @property int|null $tiempo_cultivo_max_dias
 * @property string|null $fecundacion
 * @property bool $aporque
 *
 * @property \App\Model\Entity\Plant $plant
 * @property \App\Model\Entity\Season[] $seasons
 * @property \App\Model\Entity\Source[] $sources
 * @property \App\Model\Entity\Substrate[] $substrates
 * @property \App\Model\Entity\Tip[] $tips
 */
class DataSheet extends Entity
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
        'volumen_maceta_ltr' => true,
        'profundidad_cm' => true,
        'tamano' => true,
        'horas_sol_min' => true,
        'horas_sol_max' => true,
        'riego' => true,
        'tutorado' => true,
        'planta_id' => true,
        'distancia_max_cm' => true,
        'temperatura_max' => true,
        'temperatura_min' => true,
        'tolera_sombra' => true,
        'distancia_min_cm' => true,
        'tiempo_cultivo_min_dias' => true,
        'tiempo_cultivo_max_dias' => true,
        'fecundacion' => true,
        'aporque' => true,
        'plant' => true,
        'seasons' => true,
        'sources' => true,
        'substrates' => true,
        'tips' => true,
    ];
}
