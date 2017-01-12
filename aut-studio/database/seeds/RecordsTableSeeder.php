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
                "score" => 2020,
                "level" => 100,
                "displacement" => 4,
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
            [
                "score" => 24000,
                "level" => 51,
                "displacement" => 10,
                "user_id" => 4,
                "game_id" => 1,
            ],
            [
                "score" => 34000,
                "level" => 51,
                "displacement" => 2,
                "user_id" => 5,
                "game_id" => 1,
            ],
            [
                "score" => 15000,
                "level" => 51,
                "displacement" => -9,
                "user_id" => 5,
                "game_id" => 2,
            ],
            [
                "score" => 41500,
                "level" => 51,
                "displacement" => 8,
                "user_id" => 6,
                "game_id" => 1,
            ],
            [
                "score" => 21200,
                "level" => 51,
                "displacement" => -4,
                "user_id" => 7,
                "game_id" => 1,
            ],
            [
                "score" => 22500,
                "level" => 51,
                "displacement" => -31,
                "user_id" => 8,
                "game_id" => 1,
            ],
            [
                "score" => 14900,
                "level" => 51,
                "displacement" => 22,
                "user_id" => 9,
                "game_id" => 1,
            ],
            [
                "score" => 14200,
                "level" => 51,
                "displacement" => 19,
                "user_id" => 11,
                "game_id" => 1,
            ],
            [
                "score" => 14000,
                "level" => 51,
                "displacement" => 14,
                "user_id" => 10,
                "game_id" => 1,
            ],
            [
                "score" => 12500,
                "level" => 51,
                "displacement" => 12,
                "user_id" => 2,
                "game_id" => 2,
            ]

        ];
        DB::table('records')->insert(attach_timestamps($data));
    }
}
