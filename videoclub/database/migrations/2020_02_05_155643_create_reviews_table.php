<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('review');
            $table->integer('stars');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->unisgned();
            $table->unsignedBigInteger('movie_id')->unisgned();
        });

        Schema::table('reviews', function ($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
