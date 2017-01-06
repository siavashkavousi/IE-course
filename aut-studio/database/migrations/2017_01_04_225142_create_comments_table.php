<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('rate');
            $table->string('date');
            $table->integer('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });

        $this->addInitialData();
    }

    private function addInitialData()
    {
        $comments = loadJSON('comments.json');
        foreach ($comments as $comment) {
            DB::table('comments')->insert(array_merge($comment, ['date' => Carbon::now()]));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
