<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Enter details for registration'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->hidden('status', array('value' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Register')); ?>
</div>