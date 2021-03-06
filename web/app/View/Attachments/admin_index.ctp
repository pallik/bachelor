<div class="attachments">
	<h2><?php echo __('Attachments'); ?></h2>

	<div class="actions" style="width: auto; margin: 10px 0 20px 0">
<!--		<ul>-->
<!--			<li>--><?php //echo $this->Html->link(__('New Attachment'), array('admin' => true, 'action' => 'add')); ?><!--</li>-->
<!--			<li>--><?php //echo $this->Html->link(__('List Lessons'), array('admin' => true, 'controller' => 'lessons', 'action' => 'index')); ?><!-- </li>-->
<!--			<li>--><?php //echo $this->Html->link(__('New Lesson'), array('admin' => true, 'controller' => 'lessons', 'action' => 'add')); ?><!-- </li>-->
<!--		</ul>-->
		<?php echo $this->Html->link(__('Show all'), array('admin' => true, 'action' => 'index')); ?>
		<?php echo $this->Html->link(__('New Attachment'), array('admin' => true, 'action' => 'add')); ?>
<!--		--><?php //echo $this->Html->link(__('New Lesson'), array('admin' => true, 'controller' => 'lessons', 'action' => 'add')); ?>
	</div>

	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th>--><?php //echo $this->Paginator->sort('id'); ?><!--</th>-->
<!--			<th>--><?php //echo $this->Paginator->sort('user_id'); ?><!--</th>-->
		<th><?php echo $this->Paginator->sort('name'); ?></th>
		<th><?php echo $this->Paginator->sort('type_id'); ?></th>
		<!--			<th>--><?php //echo $this->Paginator->sort('parent_id'); ?><!--</th>-->
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
<!--			<th>--><?php //echo $this->Paginator->sort('lft'); ?><!--</th>-->
<!--			<th>--><?php //echo $this->Paginator->sort('rght'); ?><!--</th>-->
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attachments as $attachment): ?>
	<tr>
<!--		<td>--><?php //echo h($attachment['Attachment']['id']); ?><!--&nbsp;</td>-->
<!--		<td>-->
<!--			--><?php //echo $this->Html->link($attachment['User']['id'], array('controller' => 'users', 'action' => 'view', $attachment['User']['id'])); ?>
<!--		</td>-->
		<td>
			<?php echo $this->Html->link(h($attachment['Attachment']['name']),
				array('admin' => true, 'action' => 'view', $attachment['Attachment']['id'])); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attachment['Type']['name'],
				array('admin' => true,  'action' => 'index', $attachment['Type']['name'])); ?>
		</td>
		<!--		<td>--><?php //echo h($attachment['Attachment']['parent_id']); ?><!--&nbsp;</td>-->
		<td><?php echo h($attachment['Attachment']['url']); ?>&nbsp;</td>
		<td><?php echo $this->Text->truncate(h($attachment['Attachment']['text']),
			100); ?>&nbsp;</td>
<!--		<td>--><?php //echo h($attachment['Attachment']['lft']); ?><!--&nbsp;</td>-->
<!--		<td>--><?php //echo h($attachment['Attachment']['rght']); ?><!--&nbsp;</td>-->
		<td><?php echo $this->Layout->status($attachment['Attachment']['status']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['created']); ?>&nbsp;</td>
		<td><?php echo h($attachment['Attachment']['modified']); ?>&nbsp;</td>
		<td class="actions">
<!--			--><?php //echo $this->Html->link(__('View'), array('admin' => true, 'action' => 'view', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('admin' => true, 'action' => 'edit', $attachment['Attachment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('admin' => true, 'action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?>
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