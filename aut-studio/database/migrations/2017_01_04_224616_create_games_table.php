<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('abstract');
            $table->longText('info');
            $table->decimal('rate');
            $table->string('large_image');
            $table->string('small_image');
            $table->integer('number_of_comments');
            $table->timestamps();
        });

        addInitialData('games');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
