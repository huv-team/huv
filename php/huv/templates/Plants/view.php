<!-- File: templates/Plants/view.php -->

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Plant $plant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Plant'), ['action' => 'edit', $plant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Plant'), ['action' => 'delete', $plant->id], ['confirm' => __('Are you sure you want to delete {0}?', $plant->nombre_popular), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plant'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Plant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plant view content">
            <h3><?= h($plant->nombre_popular), ' (', h($plant->nombre_cientifico), ')'?></h3>
            <table>
                <tr>
                    <th><?= __('Familia') ?></th>
                    <td><?= $plant->has('family') ? $this->Html->link($plant->family->nombre_popular, ['controller' => 'Families', 'action' => 'view', $plant->family]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Variedad') ?></th>
                    <td><?= h($plant->variedad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= $plant->has('type') ? $this->Html->link($types[$plant->type->nombre], ['controller' => 'Types', 'action' => 'view', $plant->type_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($plant->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
