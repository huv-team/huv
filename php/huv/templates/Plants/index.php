<!-- File: templates/Plants/index.php -->

<h1>Plantas</h1>
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

        <!-- Here is where we iterate through our $articles query object, printing out article info -->
        
        <?php foreach ($plants as $plant): ?>
        <tr>
            <td><?= $this->Number->format($plant->id) ?></td>
            <td><?= h($plant->nombre_popular) ?></td>
            <td><?= h($plant->nombre_cientifico) ?></td>
            <td><?= $plant->has('family') ? $this->Html->link($plant->family->nombre_popular, ['controller' => 'Families', 'action' => 'view', $plant->family]) : "" ?></td>
            <td><?= h($plant->variedad) ?></td>
            <td><?= $this->Html->link($types[$plant->type->nombre], ['controller' => 'Types', 'action' => 'view', $plant->type_id])?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $plant->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $plant->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $plant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
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