<?php
echo "Ảnh của sản phẩm ".$product->name ."<br>";
foreach ($images as $image) {
	echo $image->path ."<br>";
}
?>