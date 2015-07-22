<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShameTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shame_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('shame_id')->unsigned();
            $table->foreign('shame_id')->references('id')->on('shames');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shame_tag');
    }
}
