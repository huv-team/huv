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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $plant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Plants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plantasPlanta form content">
            <?= $this->Form->create($plant) ?>
            <fieldset>
                <legend><?= __('Edit Plant') ?></legend>
                <?php
                    echo $this->Form->control('nombre_popular');
                    echo $this->Form->control('nombre_cientifico');
                    echo $this->Form->control('variedad');
                    echo $this->Form->control('Familia', ['options' => $plantFamily, 'empty' => true]);
                    echo $this->Form->control('tipo', ['options' => $plantType, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
