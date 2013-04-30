<div class="attachments form">
	<?php echo $this->Form->create('Attachment', array('type' => 'file', 'url' => $action)); ?>
	<fieldset>
		<legend><?php echo __('Upload video'); ?></legend>
	<?php
		$submitTitle = 'Submit';
		if (!$token) {
			echo $this->Form->hidden('type_id', array('value' => $typeId));
			echo $this->Form->input('name');
			echo $this->Form->input('text', array('label' => 'Description'));
			echo $this->Form->input('status', array('checked' => 'checked'));
			$submitTitle = 'Next step';
		} else {
			echo $this->Form->input('file', array('type' => 'file'));
			echo $this->Form->hidden('token', array('value' => $token, 'name' => 'token'));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__($submitTitle)); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timestamps'), array('controller' => 'timestamps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?> </li>
	</ul>
</div>
