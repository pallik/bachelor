<div class="courses form">
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Course'); ?></legend>
	<?php
		echo $this->Form->hidden('user_id', array('value' => $authUser['id']));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('year', array(
			'value' => date('Y'),
			'type' => 'date',
			'dateFormat' => 'Y',
			'minYear' => date('Y') - 2,
			'maxYear' => date('Y') + 2,
			'value' => date('Y')
		));
		echo $this->Form->input('status', array('checked' => 'checked'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
