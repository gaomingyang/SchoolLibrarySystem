<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBorrowAllowedSquadsToSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system', function ($table) {
            $table->string('borrow_allowed_squads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system', function ($table) {
            $table->dropColumn(['borrow_allowed_squads']);
        });
    }
}
