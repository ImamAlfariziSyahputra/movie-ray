<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('director_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('poster');
            $table->string('banner');
            $table->string('desc')->nullable();
            $table->text('synopsis');
            $table->string('trailer');
            $table->unsignedBigInteger('year_id');
            $table->integer('duration');
            $table->string('imdb_rating');
            $table->timestamps();

            $table->foreign('director_id')
                ->references('id')
                ->on('directors')
                ->onDelete('cascade');

            $table->foreign('year_id')
                ->references('id')
                ->on('years')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
