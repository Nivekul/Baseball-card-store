<?php
	$i = 0;
	echo '<div id="grid">';
		echo '<div id = "inGrid_100">';
		echo anchor(site_url('admin/index'),'PRODUCTS', 'id=start_shopping style="margin-top:0px;"');
		echo anchor(site_url('admin/allOrders'),'ALL ORDERS', 'id=start_shopping style="margin-top:0px;"');
		echo anchor(site_url('admin/deleteAll'),'DELETE ALL', 'id=start_shopping style="margin-top:0px;"onClick="return confirm(\'Do you really want to delete ALL records?\');"');
		echo '</div>';
		echo "<div id ='inGrid'>
				<div id='product' style='background: #999;'>
					<div id='add_product'>" . anchor('store/newForm/','ADD NEW', 'id="no_decor"') . "</div>
				</div>";
		echo "<div id ='product-name' style='opacity:0;'>.</div>";
		echo "<div id ='product-desc' style='opacity:0;'>.</div>";
		echo "<div id ='product-price' style='opacity:0;'>.</div></div>";
	foreach ($products as $product) {
		echo "<div id ='inGrid'>
				<div id='product' style='background: url(" . base_url() . "images/product/" . $product->photo_url . ") no-repeat;background-size: cover; background-position: center;'>
					<div id='add'>" . anchor('store/delete/'.$product->id,'DELETE', 'id="no_decor" onClick="return confirm(\'Do you really want to delete this record?\');"') . '<br>'
									. anchor('store/update/'.$product->id,'EDIT', 'id="no_decor"') ."</div>
				</div>";
		echo "<div id ='product-name'>" . $product->name . "</div>";
		echo "<div id ='product-desc'>" . $product->description . "</div>";
		echo "<div id ='product-price'>$" . number_format($product->price, 2, '.', '') . "</div></div>";
		$i += 1;
	}
	echo '</div>';
?>
