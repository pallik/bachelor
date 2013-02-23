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
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($block['Block']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($block['Block']['is_deleted']); ?>
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
	</ul>
</div>
