<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar"> -->
    <!-- <ul class="side-nav"> -->
    <!-- ulは順序のない項目を並べるタグ。liはul内で実際に項目ごとに付けるタグ。 -->
        <!-- <li class="heading"><?= __('Actions') ?></li> -->
        <p><?= $this->Html->link(__('従業員登録'), ['action' => 'add']) ?></p>
        <p><?= $this->Html->link(__('従業員検索'), ['action' => 'search']) ?></p>
        <!-- $this->Html->linkはCakePHPのHTMLhelperと呼ばれる機能。
        この機能を利用することでHTMLのリンクを作成したり画像の出力を行うなどが出来る。
        linkメソッドはアクションをした際に指定したURLに移動するための機能。
        $this->Html->link(‘タイトル’, $URL, $オプション);
        $this->Html->link(‘タイトル’, ['controller' => 'コントローラ名', 'action' => 'アクション名', 引数1,$クエリ文字列オプション]);
        といった記述で-->
    <!-- </ul> -->
<!-- </nav> -->
<div class="employees index large-9 medium-8 columns content">
<!-- 従業員一覧を記載 -->
    <h3><?= __('従業員一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <!-- 表の頭 -->
            <tr>
            <!-- trタグにて表の横一行を定義。thタグでで表のヘッダに記述する。
            thのscopeは同じセルだと明示するタグ。colは同じ列の見出しセルであることを示す。 -->
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('名前') ?></th>
                <th scope="col"><?= $this->Paginator->sort('役職') ?></th>
                <!-- <th scope="col" class="actions"><?= __('Actions') ?></th> -->
            </tr>
        </thead>
        <tbody>
        <!-- 表のメイン -->
            <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= $this->Number->format($employee->id) ?></td>
                <td><?= h($employee->name) ?></td>
                <?php if ($employee->position_id == null): ?>
                    <td>なし</td>
                <?php else :?>
                    <td><?=$employee->position->position_name?></td>
                <?php endif; ?>
                
                <!-- <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?>
                </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php //foreach($employees as $employee){echo $employee;}?>
    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <!-- 以下登録フォーム -->
    <!-- <div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('従業員登録') ?></legend>
        <?php
            echo $this->Form->control('氏名');
            echo $this->Form->control('position');
            // echo '役職';
            // echo $this->Form->select('position',$options = array(1=>'部長',2=>'課長'))
            //,[['value'=>'null','text'=>'なし'],
            //     ['value'=>1,'text'=>'部長'],
            //     ['value'=>2,'text'=>'課長']])
        ?>
    </fieldset>
    <?= $this->Form->button(__('登録')) ?>
    <?= $this->Form->end() ?>
    </div> -->
</div>
