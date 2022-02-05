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
            <?= $this->Html->link(__('List Plants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="plant form content">
            <?= $this->Form->create($family) ?>
            <fieldset>
                <legend><?= __('Add Plant') ?></legend>
                <?php
                    echo $this->Form->control('nombre_popular');
                    echo $this->Form->control('nombre_cientifico');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
