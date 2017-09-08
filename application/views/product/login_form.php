<?php
	echo "<div id='forms'>
			<div id='inGrid_half'>
				<div id='login_form'>";

	echo '<div id="form_title">Login</div>';
	echo form_open('login/signin');
	echo form_input('username', set_value('username'), 'placeholder="Username"');
	echo '<br>';
	echo form_password('password', '', 'placeholder="Password"');
	echo '<br>';
	echo form_submit('submit', 'LOGIN');
	echo form_close();
	if ($login) {
		echo '<div id="error">';
		echo validation_errors() . '</div>';
	}

	echo "</div>
			</div>
			<div id='seperator'></div>
			<div id='inGrid_half'>
				<div id='signup_form'>";

	echo '<div id="form_title">Create an Account</div>';
	echo form_open('login/signup');
	echo form_input('first', set_value('first'), 'placeholder="Fisrt Name"');
	echo '<br>';
	echo form_input('last', set_value('last'), 'placeholder="Last Name"');
	echo '<br>';
	echo form_input('signup_username', set_value('signup_username'), 'placeholder="Username"');
	echo '<br>';
	echo form_password('signup_password', '', 'placeholder="Password"');
	echo '<br>';
	echo form_password('confPassword', '', 'placeholder="Confirm Password"');
	echo '<br>';
	echo form_input('email', set_value('email'), 'placeholder="Email Address"');
	echo '<br>';
	echo form_submit('submit', 'CREATE ACCOUNT');
	echo form_close();
	if ($signup) {
		echo '<div id="error">';
		echo validation_errors() . '</div>';
	}
?>	
		</div>
	</div>
</div>