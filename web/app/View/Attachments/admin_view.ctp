<div class="attachments view">
<h2><?php  echo __('Attachment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachment['User']['id'], array('controller' => 'users', 'action' => 'view', $attachment['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachment['Type']['name'], array('controller' => 'types', 'action' => 'view', $attachment['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Attachment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attachment['ParentAttachment']['name'], array('controller' => 'attachments', 'action' => 'view', $attachment['ParentAttachment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Deleted'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['is_deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attachment'), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attachment'), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Attachments'); ?></h3>
	<?php if (!empty($attachment['ChildAttachment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attachment['ChildAttachment'] as $childAttachment): ?>
		<tr>
			<td><?php echo $childAttachment['id']; ?></td>
			<td><?php echo $childAttachment['user_id']; ?></td>
			<td><?php echo $childAttachment['type_id']; ?></td>
			<td><?php echo $childAttachment['parent_id']; ?></td>
			<td><?php echo $childAttachment['name']; ?></td>
			<td><?php echo $childAttachment['url']; ?></td>
			<td><?php echo $childAttachment['text']; ?></td>
			<td><?php echo $childAttachment['lft']; ?></td>
			<td><?php echo $childAttachment['rght']; ?></td>
			<td><?php echo $childAttachment['is_deleted']; ?></td>
			<td><?php echo $childAttachment['created']; ?></td>
			<td><?php echo $childAttachment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attachments', 'action' => 'view', $childAttachment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attachments', 'action' => 'edit', $childAttachment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attachments', 'action' => 'delete', $childAttachment['id']), null, __('Are you sure you want to delete # %s?', $childAttachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Timestamps'); ?></h3>
	<?php if (!empty($attachment['Timestamp'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Attachment Id'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attachment['Timestamp'] as $timestamp): ?>
		<tr>
			<td><?php echo $timestamp['id']; ?></td>
			<td><?php echo $timestamp['attachment_id']; ?></td>
			<td><?php echo $timestamp['start']; ?></td>
			<td><?php echo $timestamp['end']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timestamps', 'action' => 'view', $timestamp['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'timestamps', 'action' => 'edit', $timestamp['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'timestamps', 'action' => 'delete', $timestamp['id']), null, __('Are you sure you want to delete # %s?', $timestamp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Blocks'); ?></h3>
	<?php if (!empty($attachment['Block'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lesson Id'); ?></th>
		<th><?php echo __('Target'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Is Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attachment['Block'] as $block): ?>
		<tr>
			<td><?php echo $block['id']; ?></td>
			<td><?php echo $block['lesson_id']; ?></td>
			<td><?php echo $block['target']; ?></td>
			<td><?php echo $block['position']; ?></td>
			<td><?php echo $block['is_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blocks', 'action' => 'view', $block['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blocks', 'action' => 'edit', $block['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blocks', 'action' => 'delete', $block['id']), null, __('Are you sure you want to delete # %s?', $block['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
