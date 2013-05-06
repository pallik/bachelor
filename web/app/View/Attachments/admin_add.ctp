<div class="attachments form">
	<?php if (!$type) {
		echo $this->Html->link('Add video', array('video')) . '<br />';
		echo $this->Html->link('Add image', array('image')) . '<br />';
		echo $this->Html->link('Add presentation', array('presentation')) . '<br />';
		echo $this->Html->link('Add text', array('text')) . '<br />';
	} else {
		$inputs = '';
		$subtitle = '';
		echo $this->Form->create('Attachment', array('type' => 'file'));

		switch ($type) {
			case 'video':
				$subtitle = $this->Html->link('Upload video from your computer here', array(
					'action' => 'uploadVideo'));
				$inputs = $this->Form->input('url');
				break;
			case 'image':
			case 'presentation':
				$subtitle =  'Insert URL of file OR choose files from your computer';
				$inputs = $this->Form->input('url');
				$inputs .= $this->Form->input('files.', array('type' => 'file', 'multiple', 'label' => 'Files'));
				break;
			case 'text':
				$inputs = $this->Form->input('text');
				break;
		}
		?>
		<fieldset>
			<legend><?php echo __('Admin Add Attachment'); ?></legend>
			<?php

			echo $subtitle;

			echo $this->Form->hidden('type_id', array('value' => $typeId));
			echo $this->Form->input('name');

			echo $inputs;

			echo $this->Form->input('status', array('checked' => 'checked'));
			?>
		</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
	<?php }	?>
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
