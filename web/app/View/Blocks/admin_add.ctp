<div class="blocks form">
<?php echo $this->Form->create('Block'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Block'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Blocks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
