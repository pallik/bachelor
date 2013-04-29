<div class="courses form">
<?php echo $this->Form->create('Course'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Course'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('user_id', array('value' => $authUser['id']));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('year', array(
			'selected' => array(
				'year' => $this->request->data['Course']['year']
			),
			'type' => 'date',
			'dateFormat' => 'Y',
			'minYear' => date('Y') - 2,
			'maxYear' => date('Y') + 2,
		));
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Course.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Course.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Courses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
