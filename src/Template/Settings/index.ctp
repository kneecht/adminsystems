<?php
use Cake\Core\Configure;

$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<h1>Settings</h1>
<?= __('Search') ?> <input id="filter" type="text"/>
<table id="tablefilter" class="table table-striped" cellpadding="0" cellspacing="0" data-filter="#filter" data-filter-text-only="true">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('name'); ?></th>

            <th><?= $this->Paginator->sort('value'); ?></th>

            <th><?= __('Description') ?></th>

            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($settings as $setting): 
        $usedSettings[] = $setting->name;
        ?>
        <tr class="tableclick">
            <td><?= h($setting->name) ?></td>
            <td><?= h($setting->value) ?></td>
            <td><?php if(!empty(Configure::read('Settings.Descriptions.' . $setting->name))) echo h(Configure::read('Settings.Descriptions.' . $setting->name)); ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'edit', $setting->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil doaction', 'id' => 'edit/' . $setting->id]) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; 

        // add default settings
        foreach ($availableSettings as $setting=>$info): 
        if(!empty($usedSettings) && in_array($setting, $usedSettings)) continue;
        ?>
        <tr class="tableclick">
            <td><?= h($setting) ?></td>
            <td><?= h($info['Value']) ?></td>
            <td><?php if(!empty(Configure::read('Settings.Descriptions.' . $setting))) echo h(Configure::read('Settings.Descriptions.' . $setting)); ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'add', $setting], ['title' => __('Add'), 'class' => 'btn btn-default glyphicon glyphicon-plus doaction', 'id' => 'add/' . $setting]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>