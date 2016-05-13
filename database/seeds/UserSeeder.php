<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

		User::create([
			'name'=>'图书室',
			'email'=>'tss@dashun.com',
			'password'=>Hash::make('admin123'),
			'remember_token'=>'',
		]);
    }
}
