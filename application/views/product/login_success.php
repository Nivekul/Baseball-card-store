<div id='Grid'>
	<div id='center'>
<?php
	echo '<div id="success_msg">' . $message . '</div>';
	echo '<div id="login_msg">You are logged in as ' . $this->session->userdata('username') . '.</div>';
	echo anchor(site_url(),'START SHOPPING', 'id=start_shopping');
	echo anchor(site_url('bag/index'),'SHOPPING BAG', 'id=start_shopping');
?>
</div>
</div>