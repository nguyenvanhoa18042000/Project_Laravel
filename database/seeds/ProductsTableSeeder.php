<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('products')->truncate();

    	for ($i=1; $i <=20 ; $i++) { 
    		DB::table('products')->insert([
	            'name' => 'Iphone '.$i,
	            'slug' => 'iphone-'.$i,
	            'description' => 'Điện thoại Hàng hịn',
	            'category_id' => 1,
	            'content' => 'Điện thoại tốt',
	            'origin_price' => 20000000,
	            'sale_price' => 25000000,
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]); 	
    	}
    }
}
