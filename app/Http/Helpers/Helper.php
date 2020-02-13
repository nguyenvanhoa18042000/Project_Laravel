<?php
namespace App\Http\Helpers;

class Helper{
	public static function data_tree($categories,$select = 0,$not_echo = 0, $parent_id = 0, $str = ""){
		foreach ($categories as $category) {	
			$id = $category['id'];
			$name = $category['name'];
			if ($category['parent_id'] == $parent_id) {
				if ($select != 0 && $select == $id && $id != $not_echo) {
					echo "<option value = '$id' selected>$str $name</option>";
				}elseif($id != $not_echo){
					echo "<option value = '$id'> $str $name</option>";	
				}
				self::data_tree($categories,$select,$not_echo,$id,$str."--");
			}
		}
	}
}
?>