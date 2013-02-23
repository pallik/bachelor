<div class="timestamps view">
<h2><?php  echo __('Timestamp'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timestamp['Timestamp']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attachment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($timestamp['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $timestamp['Attachment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($timestamp['Timestamp']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($timestamp['Timestamp']['end']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Timestamp'), array('action' => 'edit', $timestamp['Timestamp']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timestamp'), array('action' => 'delete', $timestamp['Timestamp']['id']), null, __('Are you sure you want to delete # %s?', $timestamp['Timestamp']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timestamps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timestamp'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
	</ul>
</div>
