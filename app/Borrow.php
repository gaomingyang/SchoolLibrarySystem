<?php

namespace App;
use App\Book;
use App\Student;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table="borrow";

    protected $fillable = ['book_id','number','student_id','comment','borrow_time','return_time'];

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function student()
    {
    	return $this->belongsTo('App\Student')->withoutGlobalScopes();
    }
}
