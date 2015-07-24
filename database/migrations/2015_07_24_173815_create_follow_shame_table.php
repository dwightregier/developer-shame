<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowShameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_shame', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // Foreign Key Restraints
            $table->integer('shame_id')->unsigned();
            $table->foreign('shame_id')->references('id')->on('shames');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('follow_shame');
    }
}
