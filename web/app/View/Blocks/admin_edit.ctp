<div class="blocks form">
<?php echo $this->Form->create('Block'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Block'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('lesson_id');
		echo $this->Form->input('target');
		echo $this->Form->input('position');
		echo $this->Form->input('is_deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Block.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Block.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
