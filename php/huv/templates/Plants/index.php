<!-- File: templates/Plants/index.php -->

<div class="flex">

    <div class="flex-auto flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Planta
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Familia
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Variedad
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipo
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($plants as $plant) : ?>
                                <tr>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <?php if ($plant->data_sheet) : ?>
                                            <div class="text-sm text-green-500 hover:text-green-900">
                                                <?= $this->Html->link($plant->family->nombre_popular, ['controller' => 'DataSheets', 'action' => 'view', $plant->data_sheet->id]) ?>
                                            </div>
                                        <?php else : ?>
                                            <div class="text-sm text-green-500">
                                                <?= h($plant->family->nombre_popular) ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="text-sm text-gray-500">
                                            <?= h($plant->nombre_cientifico) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap">
                                        <div class="text-sm text-green-500 hover:text-green-900">
                                            <?= $plant->has('family') ? $this->Html->link($plant->family->nombre_popular, ['controller' => 'Families', 'action' => 'view', $plant->family_id]) : "" ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= $plant->has('family') ? $plant->family->nombre_cientifico : '' ?>
                                        </div>
                                    </td>
                                    <td class="text-center px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                                        <?= $plant->variedad ? h($plant->variedad) : '<i class="far fa-frown"></i>' ?>
                                    </td>
                                    <td class="text-center px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                                        <?= $plant->has('type') ? $types[$plant->type->nombre] : '' ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!--h1>Plantas</h1

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div> -->