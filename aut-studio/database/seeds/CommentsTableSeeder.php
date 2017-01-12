<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            [
                "text" => "بدک نبود!",
                "rate" => 4,
                "date" => Carbon::now(),
                "user_id" => 1,
                "game_id" => 1,
            ],
            [
                "text" => "بازی خوبیه",
                "rate" => 4,
                "date" => Carbon::yesterday(),
                "user_id" => 2,
                "game_id" => 1,
            ],
            [
                "text" => "عجب چیزی",
                "rate" => 4,
                "date" => Carbon::tomorrow(),
                "user_id" => 1,
                "game_id" => 2,
            ],
            [
                "text" => "بازی خوبیه",
                "rate" => 4,
                "date" => Carbon::createFromDate(2017, 2, 14),
                "user_id" => 3,
                "game_id" => 1,
            ],
            [
                "text" => "خیلی باحاله",
                "rate" => 3,
                "date" => Carbon::createFromDate(2017, 1, 20),
                "user_id" => 3,
                "game_id" => 2,
            ],
        ];
        DB::table('comments')->insert($data);
    }
}
