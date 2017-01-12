<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(CategoryGamePivotTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RecordsTableSeeder::class);
        $this->call(TutorialsTableSeeder::class);
    }
}
