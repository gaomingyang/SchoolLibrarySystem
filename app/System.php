<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\System;

class System extends Model
{
    protected $table="system";
    // protected $primaryKey = null;
    // public $incrementing = false;

    protected $fillable=['front_name','system_name','borrow_number_limit','borrow_days_limit','borrow_allowed_squads','rank_from_date'];
    public $timestamps=false;

    public static function front_name(){
    	$system = System::first();
    	return $system->front_name;
    }
    public static function system_name(){
    	$system = System::first();
    	return $system->system_name;
    }

    public static function borrow_number_limit(){
        $system=System::first();
        return $system->borrow_number_limit;
    }

}
