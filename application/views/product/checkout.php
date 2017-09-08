<div id='Grid'>

<?php
$total=0;
$orders = $this->session->userdata('orders');
	echo '<div id="title">Checkout</div>
			<div id="inGrid_60">
				<div id="order_item_titles">
					<div id="order_desc_left">
						<div id="tr_left">ITEM</div>
					</div>
					<div id="order_desc_right">
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
						<div id="small_img" style="background: url(' . base_url() . 'images/product/' . $product->photo_url . ') no-repeat; background-size: cover;"></div>
						<div id="inline">
							<div id="title_big">' . $product->name . '</div>
							<br>
							<div id="title_small">' . $product->description . '</div>
						</div>
					</div>
					<div id="order_desc_right">
						<div id="title_small_right">$ ' . number_format($subtotal, 2, '.', '') . '</div>
						<div id="title_small_right">' . $quantity . '</div>
						<div id="title_small_right">$ ' . number_format($product->price, 2, '.', '') . '</div>
					</div>
				</div>';
	}

	echo 		'<div id="total_right">
					<div id="login_msg">Total: $' . number_format($total, 2, '.', '') . '</div>
				</div>
			</div>
		<div id="inGrid_40">
			<div id="fixed">';
				echo form_open('bag/checkout');
				echo '<div id="title_small" style="margin-bottom:30px;">Payment Infomation</div>';
				//echo '<div id="title_small" style="text-align:left;">Card Number</div>';
				echo form_input('card_number', set_value('card_number'), 'placeholder="Card Number"');
				//echo '<div id="title_small" style="text-align:left;">Expiration Date</div>';
				echo '<br>';
				echo form_input('expire_date', '', 'placeholder="Expiration Date: MM/YY"');
				echo '<br>';
				echo form_submit('submit', 'SUBMIT');
				echo '<div id="error">' . validation_errors() . '</div>';
	echo '</div></div>';

?>
</div>
</div>