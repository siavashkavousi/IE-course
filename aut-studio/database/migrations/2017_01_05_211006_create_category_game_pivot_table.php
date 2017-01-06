<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoryGamePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_game', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('game_id')->unsigned()->index();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->primary(['category_id', 'game_id']);
        });

        $this->addInitialData();
    }

    private function addInitialData()
    {
        DB::table('category_game')->insert(
            ["category_id" => 0, "game_id" => 0],
            ["category_id" => 1, "game_id" => 0],
            ["category_id" => 0, "game_id" => 1],
            ["category_id" => 1, "game_id" => 1]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_game');
    }
}
