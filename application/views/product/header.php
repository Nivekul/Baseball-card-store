<?php
	echo "<div id='header'><div id='navWrap'><div id='nav'>";
	if ($this->session->userdata('logged_in')) { // Logged in
		echo '<div id="login">';
		echo '<div id="login_item">Welcome, ' . $this->session->userdata('username') . '!</div>';
		//echo anchor(site_url('/login/index'),'Welcome, ' . $this->session->userdata('username') . '!', 'id=login_item');
		echo anchor(site_url('/login/logout'),'LOGOUT', 'id=login_item');
		echo '</div>';
	} else {
		// Visitor
		echo '<div id=login>';
		echo anchor(site_url('/login/index'),'ACCOUNT', 'id=login_item');
		echo '</div>';
	}

	echo anchor(site_url(),'E S T O R E', 'id=estore');
	$num_items = 0;
	if ($this->session->userdata('orders')) {
		$num_items = count($this->session->userdata('orders'));
	}
	echo anchor(site_url('/bag/index'),'SHOPPING BAG ( ' . $num_items . ' )', 'id="shopping-bag"');
	echo "</div></div></div>";
?>