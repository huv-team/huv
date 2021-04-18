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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $plantasPlantum->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $plantasPlantum->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Plantas Planta'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plantasPlanta form content">
            <?= $this->Form->create($plantasPlantum) ?>
            <fieldset>
                <legend><?= __('Edit Plantas Plantum') ?></legend>
                <?php
                    echo $this->Form->control('nombre_popular');
                    echo $this->Form->control('nombre_cientifico');
                    echo $this->Form->control('familia_id', ['options' => $plantasFamilia, 'empty' => true]);
                    echo $this->Form->control('variedad');
                    echo $this->Form->control('tipo_id', ['options' => $plantasTipo, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
