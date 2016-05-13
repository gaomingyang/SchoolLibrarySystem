<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id',false,true)->index();
            $table->integer('number',false,true)->length(5)->default(1);
            $table->integer('student_id',false,true)->length(5)->index();
            $table->string('comment',100)->nullable();
            $table->timestamp('borrow_time')->nullable();
            $table->timestamp('return_time')->nullable();
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
        Schema::drop('borrow');
    }
}
