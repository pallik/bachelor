<?php
/**
 * @var $this View
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('cake.generic'));

		echo $this->Html->script(array(
			'lib/jquery-1.9.1.min',
			'lib/json2',
			'lib/underscore-min',
			'lib/popcorn-complete.min',
			'lib/backbone-min'
		));

		echo $this->Js->set('url', $this->request->base);
		echo $this->Js->set('request', $this->request);
		echo $this->Js->writeBuffer();

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php
			echo $this->Html->link('Users', array('admin' => true, 'controller' => 'users', 'action' => 'index'));
			echo $this->Html->link('Courses', array('admin' => true, 'controller' => 'courses', 'action' => 'index'));
			echo $this->Html->link('Lessons', array('admin' => true, 'controller' => 'lessons', 'action' => 'index'));
			echo $this->Html->link('Blocks', array('admin' => true, 'controller' => 'blocks', 'action' => 'index'));
			echo $this->Html->link('Attachments', array('admin' => true, 'controller' => 'attachments', 'action' => 'index'));
			echo $this->Html->link('Types', array('admin' => true, 'controller' => 'types', 'action' => 'index'));
			echo $this->Html->link('Timestamps', array('admin' => true, 'controller' => 'timestamps', 'action' => 'index'));

			?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<i>by Palli &copy;</i>
		</div>
	</div>
<!--	--><?php //echo $this->element('sql_dump'); ?>
<?php echo $this->fetch('script'); ?>
</body>
</html>