<div class="timestamps index">
	<h2><?php echo __('Timestamps'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('attachment_id'); ?></th>
			<th><?php echo $this->Paginator->sort('block_id'); ?></th>
			<th><?php echo $this->Paginator->sort('chapter'); ?></th>
			<th><?php echo $this->Paginator->sort('start'); ?></th>
			<th><?php echo $this->Paginator->sort('end'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timestamps as $timestamp): ?>
	<tr>
		<td><?php echo h($timestamp['Timestamp']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($timestamp['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $timestamp['Attachment']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($timestamp['Block']['target'], array('controller' => 'blocks', 'action' => 'view', $timestamp['Block']['id'])); ?>
		</td>
		<td><?php echo h($timestamp['Timestamp']['chapter']); ?>&nbsp;</td>
		<td><?php echo h($timestamp['Timestamp']['start']); ?>&nbsp;</td>
		<td><?php echo h($timestamp['Timestamp']['end']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $timestamp['Timestamp']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timestamp['Timestamp']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timestamp['Timestamp']['id']), null, __('Are you sure you want to delete # %s?', $timestamp['Timestamp']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Timestamp'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
