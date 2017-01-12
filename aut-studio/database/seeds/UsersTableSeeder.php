<?php

use Carbon\Carbon;
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
                'password' => bcrypt('123')],
            ['name' => 'سجاد',
                'email' => 'sajad@gmail.com',
                'password' => bcrypt('123')],
            ['name' => 'آرمین',
                'email' => 'armin@gmail.com',
                'password' => bcrypt('123')],
        ];
        DB::table('users')->insert(attach_timestamps($data));
    }
}
