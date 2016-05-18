<?php

use Illuminate\Database\Seeder;
use App\System;
class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system')->truncate();

		System::create([
			'front_name'=>'图书室',
			'system_name'=>'图书管理系统',
			'borrow_number_limit'=>'2',
			'borrow_days_limit'=>'7',
		]);
    }
}
