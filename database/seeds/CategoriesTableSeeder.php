<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('categories')->truncate();

    	DB::table('categories')->insert([
            'name' => 'Điện thoại',
            'slug' => 'dien-thoai',
            'description' => 'Các loại điện thoại phổ biến trên thế giới',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'name' => 'Tablet',
            'slug' => 'tablet',
            'description' => 'Các loại tablet phổ biến trên thế giới',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'name' => 'Laptop',
            'slug' => 'laptop',
            'description' => 'Các loại laptop phổ biến trên thế giới',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'name' => 'Phụ kiện',
            'slug' => 'phu-kien',
            'description' => 'Các loại phụ kiện phổ biến trên thế giới',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('categories')->insert([
            'name' => 'Đồng hồ',
            'slug' => 'dong-ho',
            'description' => 'Các loại đồng hồ phổ biến trên thế giới',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
