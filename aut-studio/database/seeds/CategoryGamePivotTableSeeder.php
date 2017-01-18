<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryGamePivotTableSeeder extends Seeder
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
                "category_id" => 1,
                "game_id" => 1,
            ],
            [
                "category_id" => 2,
                "game_id" => 1,
            ],
            [
                "category_id" => 3,
                "game_id" => 1,
            ],
            [
                "category_id" => 1,
                "game_id" => 2,
            ],
            [
                "category_id" => 3,
                "game_id" => 2,
            ],
            [
                "category_id" => 4,
                "game_id" => 3,
            ],
            [
                "category_id" => 5,
                "game_id" => 3,
            ],
        ];
        DB::table('category_game')->insert($data);
    }
}
