<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="employees form large-9 medium-8 columns content">
    <p><?= $this->Html->link(__('従業員一覧'), ['action' => 'index']) ?></p>
    <p>従業員検索</p>
    <?= $this->Form->create($employee,[
        // 'type' => 'POST',
        'url' => [
            'controller'=>'Employees',
            'action' =>'search'
        ]
    ]);
    ?>
    <?php
        echo '氏名'.'<br>';
        echo $this->Form->contorol('name',['required' => false]);
        echo $this->Form->error('name');
        echo $this->Form->button(__('登録'));
        echo $this->Form->end();
    ?>
    <?php 
        if ($name != ''){
            if (isset($count)){
                if ($count != 0) {
                    echo $count.'件/'.$allcounts.'件';
                }else {
                    echo $noResult;
                }
            }
        }    
    ?>
    <table><tr><th>社員番号</th><th>従業員名</th><th>役職</th></tr>
        <tbody>
        <?php if ($name != ''): ?>
            <?php foreach($results as $result):?>
                <tr>
                    <td><?= $result->id?></td>
                    <td><?= $result->name?></td>
                    <?php if ($result->position_id == null): ?>
                        <td>なし</td>
                    <?php else :?>
                        <td><?=$result->position->position_name?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach?>
        <?php endif?>    
        </tbody>
    </table>
</div>