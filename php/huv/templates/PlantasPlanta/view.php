<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlantasPlantum $plantasPlantum
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Plantas Plantum'), ['action' => 'edit', $plantasPlantum->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Plantas Plantum'), ['action' => 'delete', $plantasPlantum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plantasPlantum->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plantas Planta'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Plantas Plantum'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plantasPlanta view content">
            <h3><?= h($plantasPlantum->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre Popular') ?></th>
                    <td><?= h($plantasPlantum->nombre_popular) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Cientifico') ?></th>
                    <td><?= h($plantasPlantum->nombre_cientifico) ?></td>
                </tr>
                <tr>
                    <th><?= __('Plantas Familium') ?></th>
                    <td><?= $plantasPlantum->has('plantas_familium') ? $this->Html->link($plantasPlantum->plantas_familium->id, ['controller' => 'PlantasFamilia', 'action' => 'view', $plantasPlantum->plantas_familium->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Variedad') ?></th>
                    <td><?= h($plantasPlantum->variedad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Plantas Tipo') ?></th>
                    <td><?= $plantasPlantum->has('plantas_tipo') ? $this->Html->link($plantasPlantum->plantas_tipo->id, ['controller' => 'PlantasTipo', 'action' => 'view', $plantasPlantum->plantas_tipo->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($plantasPlantum->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
