<div class="users form">
	{{ session.flash('auth') }}
	{{ form.create('User') }}
	<fieldset>
		<legend>{{ 'Please enter your username and password.' | trans }}</legend>
		{{ form.input('username') }}
		{{ form.input('password') }}
	</fieldset>
	{{ form.end('Login' | trans) }}
</div>