<div class="attachmentsBlocks form">
<?php echo $this->Form->create('AttachmentsBlock'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Attachments Block'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('attachment_id');
		echo $this->Form->input('block_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AttachmentsBlock.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AttachmentsBlock.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments Blocks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
