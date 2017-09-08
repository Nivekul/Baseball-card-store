<?php echo '<body ' . $attributes . '>'; ?>
<script>
function print_receipt() {
    window.print();
}
</script>
<div id='Grid' style='text-align:center;'>

<?php
			$orders = $this->session->userdata('orders');
	echo '<div id="inGrid_60_nohover" style="text-align:left;">
				<div style="width:100%; padding-bottom:15px; margin-bottom: 10px; border-bottom:5px solid black;">
					<div id=estore>E S T O R E</div>
				</div>
				<div style="font-size:20px; width:100%; font-weight:bold; padding-bottom:10px; border-bottom:5px solid black;">
					Thank you for shopping with us!<br><div style="height:10px;width:60%"></div>
					This is the receipt regarding to your recent order.
				</div>
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
	$order = $this->orders_model->getOrderId($this->session->userdata('id'));
	$order_items = $this->order_items_model->getOrder($order->id);
	$total = 0;
	foreach ($order_items as $order_item) {
		$product = new product();
		$product = $this->product_model->get($order_item->product_id);
		$subtotal = $product->price*$order_item->quantity;
		$total += $subtotal;
		echo '<div id="order_item">
					<div id="order_desc_left">
						<div id="inline" style="margin:0px;">
							<div id="title_big">' . $product->name . '</div>
						</div>
					</div>
					<div id="order_desc_right">
						<div id="title_small_right" style="margin-top:0px;">$ ' . number_format($subtotal, 2, '.', '') . '</div>
						<div id="title_small_right" style="margin-top:0px;">' . $order_item->quantity . '</div>
						<div id="title_small_right" style="margin-top:0px;">$ ' . number_format($product->price, 2, '.', '') . '</div>
					</div>
				</div>';
	}

	echo 		'<div id="total_right">
					<div id="login_msg">Total: $' . number_format($total, 2, '.', '') . '</div>
				</div>
			</div>';
?>
</div>
</body>