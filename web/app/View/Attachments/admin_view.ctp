<div class="attachments view">
<h2><?php  echo __('Attachment'); ?></h2>
	<dl>
<!--		<dt>--><?php //echo __('Id'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($attachment['Attachment']['id']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('User'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo $this->Html->link($attachment['User']['id'], array('controller' => 'users', 'action' => 'view', $attachment['User']['id'])); ?>
<!--			&nbsp;-->
<!--		</dd>-->
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($attachment['Attachment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
		<?php echo h($attachment['Type']['name']); ?>
		&nbsp;
		</dd>
		<!--		<dt>--><?php //echo __('Parent Id'); ?><!--</dt>-->
		<!--		<dd>-->
		<!--			--><?php //echo h($attachment['Attachment']['parent_id']); ?>
		<!--			&nbsp;-->
		<!--		</dd>-->
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
<!--		<dt>--><?php //echo __('Lft'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($attachment['Attachment']['lft']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Rght'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($attachment['Attachment']['rght']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Layout->status($attachment['Attachment']['status']); ?>
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
		<li><?php echo $this->Html->link(__('Back to attachments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Attachment'), array('action' => 'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attachment'), array('action' => 'delete', $attachment['Attachment']['id']), null, __('Are you sure you want to delete # %s?', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('action' => 'add')); ?> </li>
<!--		<li>--><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Timestamps'), array('controller' => 'timestamps', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Timestamp'), array('controller' => 'timestamps', 'action' => 'add')); ?><!-- </li>-->
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Lessons'); ?></h3>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lesson'),
					array('controller' => 'lessons', 'action' => 'add', 'attachment' => $attachment['Attachment']['id'])); ?> </li>
		</ul>
	</div>

	<?php if (!empty($attachment['Lesson'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
<!--		<th>--><?php //echo __('Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Course Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Attachment Id'); ?><!--</th>-->
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attachment['Lesson'] as $lesson): ?>
		<tr>
<!--			<td>--><?php //echo $lesson['id']; ?><!--</td>-->
<!--			<td>--><?php //echo $lesson['course_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $lesson['attachment_id']; ?><!--</td>-->
			<td><?php echo $this->Html->link($lesson['name'], array('admin' => false, 'controller' => 'lessons', 'action' => 'view', $lesson['id'])); ?></td>
			<td><?php echo $lesson['description']; ?></td>
			<td><?php echo $this->Layout->status($lesson['status']); ?></td>
			<td><?php echo $lesson['created']; ?></td>
			<td><?php echo $lesson['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Editor'), array('controller' => 'lessons', 'action' => 'editor', $lesson['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lessons', 'action' => 'edit', $lesson['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lessons', 'action' => 'delete', $lesson['id']), null, __('Are you sure you want to delete # %s?', $lesson['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>