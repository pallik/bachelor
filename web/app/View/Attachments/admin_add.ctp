<div class="attachments form">
	<?php echo $this->Form->create('Attachment', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Attachment'); ?></legend>
	<?php
		echo $this->Form->input('type_id');
//		echo $this->Form->input('parent_id', array(
//			'options' => $parentAttachments,
//			'empty' => ''
//		));
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('text');
		echo $this->Form->input('files.', array('type' => 'file', 'multiple', 'label' => 'Files'));
		echo $this->Form->input('status', array('checked' => 'checked'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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
