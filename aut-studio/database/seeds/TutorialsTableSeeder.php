<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorialsTableSeeder extends Seeder
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
                "title" => "راهنمای بازی Super Mario Run",
                "date" => Carbon::createFromDate(2017, 2, 22),
                "game_id" => 2,
            ],
            [
                "title" => "راهنمای بازی Call of Duty: Infinite Warfare",
                "date" => Carbon::createFromDate(2016, 12, 30),
                "game_id" => 1,
            ],
        ];
        DB::table('tutorials')->insert($data);
    }
}
