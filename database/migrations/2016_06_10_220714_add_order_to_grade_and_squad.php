<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToGradeAndSquad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grades', function ($table) {
            $table->smallInteger('order',false,true)->length(2)->default(50)->after('name');
        });
        Schema::table('squads',function($table){
            $table->smallInteger('order',false,true)->length(2)->default(10)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
