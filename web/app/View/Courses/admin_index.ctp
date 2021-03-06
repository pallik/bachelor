<div class="courses">
	<h2><?php echo __('Courses'); ?></h2>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Course'), array('action' => 'add')); ?></li>
			<!--		<li>--><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?><!-- </li>-->
			<!--		<li>--><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?><!-- </li>-->
			<!--		<li>--><?php //echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?><!-- </li>-->
			<!--		<li>--><?php //echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?><!-- </li>-->
		</ul>
	</div>

	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th>--><?php //echo $this->Paginator->sort('id'); ?><!--</th>-->
<!--			<th>--><?php //echo $this->Paginator->sort('user_id'); ?><!--</th>-->
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($courses as $course): ?>
	<tr>
<!--		<td>--><?php //echo h($course['Course']['id']); ?><!--&nbsp;</td>-->
<!--		<td>-->
<!--			--><?php //echo $this->Html->link($course['User']['id'], array('controller' => 'users', 'action' => 'view', $course['User']['id'])); ?>
<!--		</td>-->
		<td><?php echo $this->Html->link(h($course['Course']['name']), array('action' => 'view', $course['Course']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->Text->truncate(h($course['Course']['description'])); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['year']); ?>&nbsp;</td>
		<td><?php echo $this->Layout->status($course['Course']['status']); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['created']); ?>&nbsp;</td>
		<td><?php echo h($course['Course']['modified']); ?>&nbsp;</td>
		<td class="actions">
<!--			--><?php //echo $this->Html->link(__('View'), array('action' => 'view', $course['Course']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $course['Course']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $course['Course']['id']), null, __('Are you sure you want to delete # %s?', $course['Course']['id'])); ?>
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