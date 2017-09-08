<div id='Grid'>

<?php
$total=0;
if ($this->session->userdata('orders')) {
	$orders = $this->session->userdata('orders');
	echo '<div id="title">Shopping Bag</div>
			<div id="inGrid_60">';
			echo form_open('bag/update');
	echo		'<div id="order_item_titles">
					<div id="order_desc_left">
						<div id="tr_left">ITEM</div>
					</div>
					<div id="order_desc_right">
						<div id="tr_right">REMOVE</div>
						<div id="tr_right">SUBTOTAL</div>
						<div id="tr_right">QUANTITY</div>
						<div id="tr_right">PRICE</div>
					</div>
				</div>';
	foreach ($orders as $id => $quantity) {
		$product = new product();
		$product = $this->product_model->get($id);
		$subtotal = $product->price*$quantity;
		$total += $subtotal;
		echo '<div id="order_item">
					<div id="order_desc_left">
						<div id="small_img" style="background: url(' . base_url() . 'images/product/' . $product->photo_url . ') no-repeat; background-size: cover; background-position: center;"></div>
						<div id="inline">
							<div id="title_big">' . $product->name . '</div>
							<br>
							<div id="title_small">' . $product->description . '</div>
						</div>
					</div>
					<div id="order_desc_right">
						<div id="remove">' . anchor('bag/remove/'.$product->id, 'X', 'id="no_decor_black"') . '</div>
						<div id="title_small_right">$ ' . number_format($subtotal, 2, '.', '') . '</div>
						<div id="quantity_form">';
							//Quantity
							echo form_input($id, $quantity, 'id="quantity_input"');
		echo			'</div>
						<div id="title_small_right">$ ' . number_format($product->price, 2, '.', '') . '</div>
					</div>
				</div>';
	}
	echo form_submit('submit', 'UPDATE', 'id="float_right"');
	echo form_close();

	echo '</div>
		<div id="inGrid_40">
			<div id="fixed">
				<div id="total">Total: $' . number_format($total, 2, '.', '') . '</div>';
			if ($this->session->userdata('logged_in')) {
				echo '<div id="login_msg">You are logged in as ' . $this->session->userdata('username') . '.</div>';
				echo anchor(site_url('/bag/checkout'),'CHECKOUT', 'id="shopping_bag_login"');
			} else {
				echo '<div id="login_msg">Login or create an account to checkout.</div>';
				echo anchor(site_url('/login/index'),'ACCOUT', 'id="shopping_bag_login"');
			}
	echo '</div></div>';
} else {
	echo '<div id="center"><div id="success_msg">Your shopping bag is empty.</div>';
	echo anchor(site_url(),'START SHOPPING', 'id=start_shopping');
}

?>
</div>
</div>