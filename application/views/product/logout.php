<div id='Grid'>
	<div id='center'>
<?php
	echo '<div id="success_msg">Hello, ' . $this->session->userdata('username') . '!</div>';
	echo '<div id="login_msg">What would you like to do?</div>';
	echo anchor(site_url(),'CONTINUE SHOPPING', 'id=start_shopping');
	echo anchor(site_url('/login/logout'),'LOGOUT', 'id=start_shopping');
?>
</div>
</div>