<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use SoftDeletes;
    protected $table="grades";
    protected $fillable=['id','name'];
    public $timestamps=false;

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function squads()
    {
        return $this->hasMany('App\Squad');
    }

}
