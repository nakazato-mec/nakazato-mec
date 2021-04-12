<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="employees form large-9 medium-8 columns content">
    <p>従業員検索</p>
    <?= $this->Form->create($employees,[
        'type' => 'POST',
        'url' => [
            'controller'=>'Employees',
            'action' =>'search'
        ]
    ]);
    ?>
    <p>氏名</p>
    <?=$this->Form->text('name',['required'=>false]);
    $this->Form->error('name');?>
    <?=$this->Form->submit('検索');?>
    <?= $this->Form->end()?>
    <!-- <p>従業員一覧</p>
    <table><tr><th>ID</th><th>名前</th><th>役職</th></tr>
    <tbody>
    <?php foreach($employees as $employee):?>
        <tr>
        <td><?= $employee->id?></td>
        <td><?= $employee->name?></td>
        <?php if ($employee->position_id == null): ?>
                    <td>なし</td>
                <?php else :?>
                    <td><?=$employee->position->position_name?></td>
                <?php endif; ?>
        </tr>
    <?php endforeach?>
    </tbody>
    </table> -->
    <!-- <?php if($result == null):?>
        <?= $noResult?>
    <?php else:?>
    <table><tr><th>ID</th><th>名前</th><th>役職</th></tr>
    <tbody>
    <?php foreach($results as $result):?>
        <tr>
        <td><?= $result->id?></td>
        <td><?= $result->name?></td>
        <?php if ($result->position_id == null): ?>
                    <td>なし</td>
                <?php else :?>
                    <td><?=$result->position->position_name?></td>
                <?php endif; ?>
        </tr>
    <?php endforeach?>
    </tbody>
    </table>
    <?php endif;?> -->
</div>