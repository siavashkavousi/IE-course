<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'سارا',
                'email' => 'sara@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/zoe.jpg"],
            ['name' => 'سجاد',
                'email' => 'sajad@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'آرمین',
                'email' => 'armin@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/christian.jpg"],
            ['name' => 'میلاد',
                'email' => 'milad@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'سروش',
                'email' => 'soroush@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'مصطفی',
                'email' => 'mostafa@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'صادق',
                'email' => 'sadegh@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'سعید',
                'email' => 'saeed@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'مهدی',
                'email' => 'mehdi@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'حجت',
                'email' => 'hojjat@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
            ['name' => 'سامان',
                'email' => 'saman@gmail.com',
                'password' => bcrypt('123'),
                "avatar" => "http://semantic-ui.com/images/avatar/small/elliot.jpg"],
        ];
        DB::table('users')->insert(attach_timestamps($data));
    }
}
