<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
    </ul>
</nav> -->
<p><?= $this->Html->link(__('従業員一覧'), ['action' => 'index']) ?></p>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('従業員登録') ?></legend>
        <?php
            echo '氏名';
            // echo $this->Form->control('name',['label'=>'氏名'],['error'=>false]);
            echo $this->Form->text('name',['required' => false]);
            echo $this->Form->error('name');
            echo '役職';
            // echo $this->Form->control('position_id');
            echo $this->Form->select('position_id',$options = array(1=>'部長',2=>'課長',3=>'係長'),
                $options=array('empty'=>'なし'));
            //,[['value'=>'null','text'=>'なし'],
            //     ['value'=>1,'text'=>'部長'],
            //     ['value'=>2,'text'=>'課長']])
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
</div>