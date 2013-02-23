<div class="lessons view">
<h2><?php  echo __('Lesson'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Course'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lesson['Course']['name'], array('controller' => 'courses', 'action' => 'view', $lesson['Course']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['is_deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lesson['Lesson']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lesson'), array('action' => 'edit', $lesson['Lesson']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lesson'), array('action' => 'delete', $lesson['Lesson']['id']), null, __('Are you sure you want to delete # %s?', $lesson['Lesson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Courses'), array('controller' => 'courses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Course'), array('controller' => 'courses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blocks'); ?></h3>
	<?php if (!empty($lesson['Block'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lesson Id'); ?></th>
		<th><?php echo __('Target'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($lesson['Block'] as $block): ?>
		<tr>
			<td><?php echo $block['id']; ?></td>
			<td><?php echo $block['lesson_id']; ?></td>
			<td><?php echo $block['target']; ?></td>
			<td><?php echo $block['position']; ?></td>
			<td><?php echo $block['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blocks', 'action' => 'view', $block['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blocks', 'action' => 'edit', $block['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blocks', 'action' => 'delete', $block['id']), null, __('Are you sure you want to delete # %s?', $block['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
