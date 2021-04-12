<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<div class="employees index large-9 medium-8 columns content">
<p><?= $this->Html->link(__('TOP'), ['action' => 'index']) ?></p>
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
                <?php endif ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- <?php foreach($employees as $employee){echo $employee;}?> -->

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
    <div><p>登録完了しました。</p></div>
</div>
