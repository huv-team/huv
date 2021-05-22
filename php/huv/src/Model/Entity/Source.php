<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Source Entity
 *
 * @property int $id
 * @property string|null $otros
 * @property string|null $url
 * @property string|null $titulo
 * @property \Cake\I18n\FrozenDate|null $acceso
 * @property string|null $anio
 * @property string|null $nombre_revista
 * @property string|null $capitulo
 * @property string|null $contenido
 * @property int|null $edicion
 * @property string|null $editorial
 * @property string|null $nombre_pag
 * @property int|null $numero
 * @property int|null $pag_fin
 * @property int|null $pag_inicio
 * @property string|null $red_social
 * @property string|null $tipo
 * @property string|null $tipo_cont
 * @property string|null $usuario
 * @property int|null $volumen
 *
 * @property \App\Model\Entity\Author[] $authors
 * @property \App\Model\Entity\DataSheet[] $data_sheets
 */
class Source extends Entity
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
        'otros' => true,
        'url' => true,
        'titulo' => true,
        'acceso' => true,
        'anio' => true,
        'nombre_revista' => true,
        'capitulo' => true,
        'contenido' => true,
        'edicion' => true,
        'editorial' => true,
        'nombre_pag' => true,
        'numero' => true,
        'pag_fin' => true,
        'pag_inicio' => true,
        'red_social' => true,
        'tipo' => true,
        'tipo_cont' => true,
        'usuario' => true,
        'volumen' => true,
        'authors' => true,
        'data_sheets' => true,
    ];
}
