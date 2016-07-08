<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Squad extends Model
{
    use SoftDeletes;
    protected $table="squads";
    protected $fillable=['id','grade_id','name'];
    public $timestamps=false;

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function seat()
    {
        return $this->hasMany('App\Seat');
    }

}
