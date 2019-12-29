<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('user')->truncate();//nếu có dòng này n sẽ xóa các lệnh ở dưới chạy lại
    	//

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0939177838',
            'password' => bcrypt('secret'),
        ]);
    }
}
