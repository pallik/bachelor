<div class="lessons ">
	<h2><?php echo __('Lessons'); ?></h2>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lesson'), array('admin' => true, 'action' => 'add')); ?></li>
			<!--		<li>--><?php //echo $this->Html->link(__('New Course'), array('admin' => true, 'controller' => 'courses', 'action' => 'add')); ?><!-- </li>-->
			<!--		<li>--><?php //echo $this->Html->link(__('New Attachment'), array('admin' => true, 'controller' => 'attachments', 'action' => 'add')); ?><!-- </li>-->
		</ul>
	</div>

	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th>--><?php //echo $this->Paginator->sort('id'); ?><!--</th>-->
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('course_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attachment_id', __('Video')); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lessons as $lesson): ?>
	<tr>
<!--		<td>--><?php //echo h($lesson['Lesson']['id']); ?><!--&nbsp;</td>-->
		<td><?php echo $this->Html->link($lesson['Lesson']['name'], array('action' => 'view', $lesson['Lesson']['id'])); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lesson['Course']['name'], array('admin' => true, 'controller' => 'courses', 'action' => 'view', $lesson['Course']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lesson['Attachment']['name'], array('admin' => true, 'controller' => 'attachments', 'action' => 'view', $lesson['Attachment']['id'])); ?>
		</td>
		<td><?php echo h($lesson['Lesson']['description']); ?>&nbsp;</td>
		<td><?php echo $this->Layout->status($lesson['Lesson']['status']); ?>&nbsp;</td>
		<td><?php echo h($lesson['Lesson']['created']); ?>&nbsp;</td>
		<td><?php echo h($lesson['Lesson']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editor'), array('admin' => true, 'action' => 'editor', $lesson['Lesson']['id'])); ?>
<!--			--><?php //echo $this->Html->link(__('View'), array('admin' => true, 'action' => 'view', $lesson['Lesson']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('admin' => true, 'action' => 'edit', $lesson['Lesson']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('admin' => true, 'action' => 'delete', $lesson['Lesson']['id']), null, __('Are you sure you want to delete # %s?', $lesson['Lesson']['id'])); ?>
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