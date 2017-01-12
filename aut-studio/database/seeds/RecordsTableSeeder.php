<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "score" => 10000,
                "level" => 41,
                "displacement" => -5,
                "user_id" => 1,
                "game_id" => 1,
            ],
            [
                "score" => 14000,
                "level" => 51,
                "displacement" => 10,
                "user_id" => 2,
                "game_id" => 1,
            ],
            [
                "score" => 20020,
                "level" => 100,
                "displacement" => 9,
                "user_id" => 3,
                "game_id" => 1,
            ],
            [
                "score" => 5400,
                "level" => 12,
                "displacement" => -8,
                "user_id" => 1,
                "game_id" => 2,
            ],
        ];
        DB::table('records')->insert(attach_timestamps($data));
    }
}
