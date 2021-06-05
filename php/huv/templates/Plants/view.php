<!-- File: templates/Plants/view.php -->

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
            <?= $this->Html->link(__('Edit Plant'), ['action' => 'edit', $plant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Plant'), ['action' => 'delete', $plant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plant'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Plant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plant view content">
            <h3><?= h($plant->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre Popular') ?></th>
                    <td><?= h($plant->nombre_popular) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Cientifico') ?></th>
                    <td><?= h($plant->nombre_cientifico) ?></td>
                </tr>
                <tr>
                    <th><?= __('Familia') ?></th>
                    <td><?= $plant->has('plantas_familia') ? $this->Html->link($plant->plantas_familia->id, ['controller' => 'PlantasFamilia', 'action' => 'view', $plant->plantas_familia->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Variedad') ?></th>
                    <td><?= h($plant->variedad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= $plant->has('plantas_tipo') ? $this->Html->link($plant->plantas_tipo->id, ['controller' => 'PlantasTipo', 'action' => 'view', $plant->plantas_tipo->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($plant->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
