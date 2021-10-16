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
            <?= $this->Html->link(__('List Plants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plant form content">
            <?= $this->Form->create($plant) ?>
            <fieldset>
                <legend><?= __('Add Plant') ?></legend>
                <?php
                    echo $this->Form->control('nombre_popular');
                    echo $this->Form->control('nombre_cientifico');
                    echo $this->Form->control('variedad');
                    echo $this->Form->control('family_id', ['label' => 'Familia', 'options' => $plantFamilies, 'empty' => true]);
                    echo $this->Form->control('type_id', ['label' => 'Tipo', 'options' => $plantTypes, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
