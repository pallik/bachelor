<div class="attachmentsBlocks view">
<h2><?php  echo __('Attachments Block'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attachmentsBlock['AttachmentsBlock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attachment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachmentsBlock['Attachment']['name'], array('controller' => 'attachments', 'action' => 'view', $attachmentsBlock['Attachment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachmentsBlock['Block']['target'], array('controller' => 'blocks', 'action' => 'view', $attachmentsBlock['Block']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachments Block'), array('action' => 'edit', $attachmentsBlock['AttachmentsBlock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attachments Block'), array('action' => 'delete', $attachmentsBlock['AttachmentsBlock']['id']), null, __('Are you sure you want to delete # %s?', $attachmentsBlock['AttachmentsBlock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments Blocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachments Block'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
	</ul>
</div>
