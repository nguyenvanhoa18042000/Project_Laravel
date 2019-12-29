<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	// $this->call(PostsTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        
        //nếu ko thực thi câu lệnh seeder có --class=UsersTableSeeder
        //thì n sẽ vào đây có những call() nào n gọi call đó 
    }
}
