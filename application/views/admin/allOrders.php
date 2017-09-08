<div id='grid' style='text-align:center;'>
<?php
	echo '<div id = "inGrid_100">';
		echo anchor(site_url('admin/index'),'PRODUCTS', 'id=start_shopping style="margin-top:0px;"');
		echo anchor(site_url('admin/allOrders'),'ALL ORDERS', 'id=start_shopping style="margin-top:0px;"');
		echo anchor(site_url('admin/deleteAll'),'DELETE ALL', 'id=start_shopping style="margin-top:0px;"');
		echo '</div>';
	$orders = $this->orders_model->getAll();
	foreach ($orders as $order) {
		$order_items = $this->order_items_model->getOrder($order->id);
		$customer = $this->customer_model->getByID($order->customer_id);
		echo '<div id=inGrid_60_nohover style="text-align:left;">
				<div style="font-size:20px; width:100%; font-weight:bold; padding:10px 0 10px 0; border-bottom:5px solid black;border-top:5px solid black;">
					' . $customer->first .' '. $customer->last . '<br>
					<div style="height:10px;width:60%"></div>
					'. $customer->email .'
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
	}






?>
</div>