<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlantasPlantum[]|\Cake\Collection\CollectionInterface $plantasPlanta
 */
?>
<div class="plantasPlanta index content">
    <?= $this->Html->link(__('New Plantas Plantum'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Plantas Planta') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nombre_popular') ?></th>
                    <th><?= $this->Paginator->sort('nombre_cientifico') ?></th>
                    <th><?= $this->Paginator->sort('familia_id') ?></th>
                    <th><?= $this->Paginator->sort('variedad') ?></th>
                    <th><?= $this->Paginator->sort('tipo_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plantasPlanta as $plantasPlantum): ?>
                <tr>
                    <td><?= $this->Number->format($plantasPlantum->id) ?></td>
                    <td><?= h($plantasPlantum->nombre_popular) ?></td>
                    <td><?= h($plantasPlantum->nombre_cientifico) ?></td>
                    <td><?= $plantasPlantum->has('plantas_familium') ? $this->Html->link($plantasPlantum->plantas_familium->id, ['controller' => 'PlantasFamilia', 'action' => 'view', $plantasPlantum->plantas_familium->id]) : '' ?></td>
                    <td><?= h($plantasPlantum->variedad) ?></td>
                    <td><?= $plantasPlantum->has('plantas_tipo') ? $this->Html->link($plantasPlantum->plantas_tipo->id, ['controller' => 'PlantasTipo', 'action' => 'view', $plantasPlantum->plantas_tipo->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $plantasPlantum->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $plantasPlantum->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $plantasPlantum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plantasPlantum->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
