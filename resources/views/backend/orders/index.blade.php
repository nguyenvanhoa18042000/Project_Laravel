<?php
	echo "Sản phẩm trong order ".$order->id ."<br>";
	foreach ($products as $product) {
		echo $product->name ."<br>";
	}
?>