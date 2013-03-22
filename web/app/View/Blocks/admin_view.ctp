<div class="blocks view">
<h2><?php  echo __('Block'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($block['Block']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lesson'); ?></dt>
		<dd>
			<?php echo $this->Html->link($block['Lesson']['name'], array('controller' => 'lessons', 'action' => 'view', $block['Lesson']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Target'); ?></dt>
		<dd>
			<?php echo h($block['Block']['target']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Style'); ?></dt>
		<dd>
			<?php echo h($block['Block']['style']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($block['Block']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Master'); ?></dt>
		<dd>
			<?php echo h($block['Block']['master']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Block'), array('action' => 'edit', $block['Block']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Block'), array('action' => 'delete', $block['Block']['id']), null, __('Are you sure you want to delete # %s?', $block['Block']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timestamps'), array('controller' => 'timestamps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Timestamps'); ?></h3>
	<?php if (!empty($block['Timestamp'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Attachment Id'); ?></th>
		<th><?php echo __('Block Id'); ?></th>
		<th><?php echo __('Chapter'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($block['Timestamp'] as $timestamp): ?>
		<tr>
			<td><?php echo $timestamp['id']; ?></td>
			<td><?php echo $timestamp['attachment_id']; ?></td>
			<td><?php echo $timestamp['block_id']; ?></td>
			<td><?php echo $timestamp['chapter']; ?></td>
			<td><?php echo $timestamp['start']; ?></td>
			<td><?php echo $timestamp['end']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timestamps', 'action' => 'view', $timestamp['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'timestamps', 'action' => 'edit', $timestamp['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'timestamps', 'action' => 'delete', $timestamp['id']), null, __('Are you sure you want to delete # %s?', $timestamp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
