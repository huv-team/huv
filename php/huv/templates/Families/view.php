<!-- File: templates/Families/view.php -->

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Family $family
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Family'), ['action' => 'edit', $family->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Family'), ['action' => 'delete', $family->id], ['confirm' => __('Are you sure you want to delete {0}?', $family->nombre_cientifico), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Families'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Family'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="family view content">
            <table>
                <tr>
                    <th><?= __('Nombre Popular') ?></th>
                    <td><?= h($family->nombre_popular) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Científico') ?></th>
                    <td><?= h($family->nombre_cientifico) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($family->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
