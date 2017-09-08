<?php
	echo "<div id='header'><div id='navWrap'><div id='nav'>";
		echo '<div id="login">';
		echo '<div id="login_item">Welcome, Administrator!</div>';
		echo anchor(site_url('/login/logout'),'LOGOUT', 'id=login_item');
		echo '</div>';
		echo anchor(site_url('admin/index'),'E S T O R E', 'id=estore');
	$num_items = 0;
	echo '<div id="shopping-bag"></div>';
	echo "</div></div></div>";
?>