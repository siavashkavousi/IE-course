<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
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
                "name" => "اکشن",
            ],
            [
                "name" => "ماجراجوئی",
            ],
            [
                "name" => "اول شخص",
            ],
            [
                "name" => "سوم شخص",
            ],
            [
                "name" => "استراتژیک",
            ],
            [
                "name" => "جنگی",
            ],
        ];
        DB::table('categories')->insert(attach_timestamps($data));
    }
}
