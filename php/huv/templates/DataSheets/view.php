<!-- File: templates/DataSheets/view.php -->

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DataSheet $data_sheet
 */
?>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            <?= h($data_sheet->plant->nombre_popular) ?>
        </h3>
        <p class="mt-1 max-w-2xl text-sm">
            <?= $data_sheet->plant->has('family') ? $this->Html->link($data_sheet->plant->family->nombre_popular, ['controller' => 'Families', 'action' => 'view', $data_sheet->plant->family_id], ['class' => "text-green-500 hover:text-green-900"]) : "" ?> | <?= h($types[$data_sheet->plant->type->nombre]) ?>
        </p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Nombre cientifico
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= h($data_sheet->plant->nombre_cientifico) ?>
                </dd>
            </div>
            <?php if( $data_sheet->volumen_maceta_ltr || $data_sheet->profundidad_cm ): ?>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-bold text-gray-500 sm:col-span-3">
                        Dimensiones de la Maceta
                    </dt>
                </div>
                <?php if( $data_sheet->volumen_maceta_ltr ): ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Volumen
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <?= $data_sheet->volumen_maceta_ltr ?> ltr.
                        </dd>
                    </div>
                <?php endif; ?>
                <?php if( $data_sheet->profundidad_cm ): ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Profundidad
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <?= $data_sheet->profundidad_cm ?> cm.
                        </dd>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if( !$data_sheet->tamano ): ?>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Tamaño de la planta
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->tamano ?>
                </dd>
            </div>
            <?php endif; ?>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Distancia entre plantas
                </dt>
                <dt class="text-sm font-medium text-gray-500">
                    Minima
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->distancia_min_cm ?> cm.
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    
                </dt>
                <dt class="text-sm font-medium text-gray-500">
                    Máxima
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->distancia_max_cm ?> cm.
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Luz de sol
                </dt>
                <dt class="text-sm font-medium text-gray-500">
                    Minima
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->horas_sol_min ?> hs.
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    
                </dt>
                <dt class="text-sm font-medium text-gray-500">
                    Máxima
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->horas_sol_max ?> hs.
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Tolera la sombra
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?= $data_sheet->tolera_sombra ? 'Sí' : 'No' ?>
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    About
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Attachments
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                            <div class="w-0 flex-1 flex items-center">
                                <!-- Heroicon name: solid/paper-clip -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 flex-1 w-0 truncate">
                                    resume_back_end_developer.pdf
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Download
                                </a>
                            </div>
                        </li>
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                            <div class="w-0 flex-1 flex items-center">
                                <!-- Heroicon name: solid/paper-clip -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 flex-1 w-0 truncate">
                                    coverletter_back_end_developer.pdf
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Download
                                </a>
                            </div>
                        </li>
                    </ul>
                </dd>
            </div>
        </dl>
    </div>
</div>