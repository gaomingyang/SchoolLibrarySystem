<?php

namespace App;

use App\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Borrow;

class Student extends Model
{
    use SoftDeletes;
    protected $table="students";
    protected $fillable=['id','grade_id','name','gender'];
    public $timestamps=false;

    protected static function boot()
    {
       parent::boot();
       static::addGlobalScope(new StudentScope);
    }



    public function gendername()
    {
        if ($this->gender == 1) {
            return '男';
        }elseif($this->gender == 2){
            return '女';
        }else{
            return '未填';
        }

    }

    // public function grade()
    // {
    //     return $this->belongsToThrough('App\Grade','App\Squad');
    // }

    public function squad()
    {
        return $this->belongsTo('App\Squad');
    }

    public function waitReturn()
    {
    	$books = Borrow::where('student_id',$this->id)
    					->where('return_time',null)
    					->get();
    	return $books;
    }

    public function borrow()
    {
        return $this->hasMany('App\Borrow');
    }
}
