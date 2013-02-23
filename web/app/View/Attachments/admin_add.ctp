<?php
/**
 * @var $this View
 */
?>

<div class="attachments form">
<?php echo $this->Form->create('Attachment'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Attachment'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('type_id');
		echo $this->Form->input('parent_id', array(
			'options' => $parentAttachments,
			'empty' => __('Choose one')
		));
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('text');
//		echo $this->Form->input('lft');
//		echo $this->Form->input('rght');
		echo $this->Form->input('is_deleted');
		echo $this->Form->input('Block');
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
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timestamps'), array('controller' => 'timestamps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
