<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Borrow;

class Student extends Model
{
    use SoftDeletes;
    protected $table="students";
    protected $fillable=['id','grade_id','name','gender'];
    public $timestamps=false;

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
    public function squad()
    {
        return $this->BelongsTo('App\Squad');
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
