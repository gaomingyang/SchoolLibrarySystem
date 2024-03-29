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
			'name'=>'admin',
			'email'=>'admin@admin.com',
			'password'=>Hash::make('admin'),
			'remember_token'=>'',
		]);
    }
}
