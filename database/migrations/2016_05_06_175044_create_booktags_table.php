<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooktagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booktags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id',false,true)->length(5);
            $table->integer('tag_id',false,true)->length(5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booktags');
    }
}
