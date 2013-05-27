<div class="courses view">
<h2><?php  echo __('Course'); ?></h2>
	<dl>
<!--		<dt>--><?php //echo __('Id'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($course['Course']['id']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('User'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo $this->Html->link($course['User']['id'], array('controller' => 'users', 'action' => 'view', $course['User']['id'])); ?>
<!--			&nbsp;-->
<!--		</dd>-->
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($course['Course']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($course['Course']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($course['Course']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo  $this->Layout->status($course['Course']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($course['Course']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($course['Course']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to courses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Course'), array('action' => 'edit', $course['Course']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Course'), array('action' => 'delete', $course['Course']['id']), null, __('Are you sure you want to delete # %s?', $course['Course']['id'])); ?> </li>
<!--		<li>--><?php //echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?><!-- </li>-->
		<li><?php echo $this->Html->link(__('New Course'), array('action' => 'add')); ?> </li>
<!--		<li>--><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?><!-- </li>-->
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Lessons'); ?></h3>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add', 'course' => $course['Course']['id'])); ?> </li>
		</ul>
	</div>

	<?php if (!empty($course['Lesson'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
<!--		<th>--><?php //echo __('Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Course Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Attachment Id'); ?><!--</th>-->
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($course['Lesson'] as $lesson): ?>
		<tr>
<!--			<td>--><?php //echo $lesson['id']; ?><!--</td>-->
<!--			<td>--><?php //echo $lesson['course_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $lesson['attachment_id']; ?><!--</td>-->
			<td><?php echo $this->Html->link($lesson['name'], array('admin' => false, 'controller' => 'lessons', 'action' => 'view', $lesson['id'])); ?></td>
			<td><?php echo $lesson['description']; ?></td>
			<td><?php echo  $this->Layout->status($lesson['status']); ?></td>
			<td><?php echo $lesson['created']; ?></td>
			<td><?php echo $lesson['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Editor'), array('controller' => 'lessons', 'action' => 'editor', $lesson['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lessons', 'action' => 'edit', $lesson['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lessons', 'action' => 'delete', $lesson['id']), null, __('Are you sure you want to delete # %s?', $lesson['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>
