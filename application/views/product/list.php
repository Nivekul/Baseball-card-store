<?php
	$i = 0;
	echo '<div id="grid">';
	foreach ($products as $product) {
		echo "<div id ='inGrid'>
				<div id='product' style='background: url(" . base_url() . "images/product/" . $product->photo_url . ") no-repeat;background-size: cover; background-position: center;'>
					<div id='add'>" . anchor('bag/add/'.$product->id,'ADD TO CART', 'id="no_decor"') . "</div>
				</div>";
		echo "<div id ='product-name'>" . $product->name . "</div>";
		echo "<div id ='product-desc'>" . $product->description . "</div>";
		echo "<div id ='product-price'>$" . number_format($product->price, 2, '.', '') . "</div></div>";
		$i += 1;
	}
	echo '</div>';
?>
