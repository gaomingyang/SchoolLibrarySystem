<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('name',50);
            $table->string('publisher',20)->nullable();
            $table->string('author',20)->nullable();
            $table->integer('number',false,true)->length(5)->default(1); //second autoincrement third unsigned
            $table->string('location',20)->nullable();
            $table->string('comment',20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
