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
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('tmdb_id')->unsigned()->unique()->nullable();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('preview_path')->nullable();
            $table->float('vote_average')->unsigned()->nullable();
            $table->float('vote_count')->unsigned()->nullable();
            $table->float('popularity')->unsigned()->nullable();
            $table->string('runtime')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->boolean('premuim')->default(0);
            $table->date('release_date')->nullable();
            $table->timestamps();
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
