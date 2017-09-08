<div id='Grid'>
	<div id='center'>
<?php
	echo '<div id="success_msg">Your order has been confirmed.</div>';
	echo '<div id="login_msg">What would you like to do with your receipt?</div>';
	echo anchor(site_url(),'IGNORE', 'id="start_shopping"');
	echo anchor(site_url('bag/email_receipt'),'E-MAIL', 'id="start_shopping"');
	echo anchor(site_url('bag/print_receipt'),'PRINT', 'id="start_shopping" target="_blank"');
?>
</div>
</div>