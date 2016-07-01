<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
// use App\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->truncate();

        DB::table('grades')->insert(
        ['id'=>1,'name'=>'一年级','order'=>50,'deleted_at'=>null],
        ['id'=>2,'name'=>'二年级','order'=>50,'deleted_at'=>null],
        ['id'=>3,'name'=>'三年级','order'=>50,'deleted_at'=>null],
        ['id'=>4,'name'=>'四年级','order'=>50,'deleted_at'=>null],
        ['id'=>5,'name'=>'五年级','order'=>50,'deleted_at'=>null],
        );
    }
}
