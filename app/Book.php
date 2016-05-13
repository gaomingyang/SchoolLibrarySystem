<?php

namespace App;
use App\Borrow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
	use SoftDeletes;

    protected $table = "books";
	protected $fillable=['name','publisher','author','category_id','number','location','comment'];


	public function borrowed(){
		return $this->hasMany(Borrow::class);
	}

	public function waitReturn()
	{
		$book_id = $this->id;
		$wrs = Borrow::where('book_id',$book_id)->where('return_time',null)->get();
		return $wrs;
	}

	public function category()
	{
			return $this->belongsTo('App\Category');
	}

	public function tags(){
		return $this->belongsToMany('App\Tag','booktags');
	}

	public function tagNameString(){
		$tags = $this->tags;
		$tag ="[";

		if (!empty($tags)) {
			foreach ($tags as $k => $v) {
				$tag .= "'$v->name',";
			}
			$tag = rtrim($tag,',');
		}

		$tag .= "]";

		return $tag;
	}

	public function hadBorrowed(){
		$b = Borrow::where('book_id',$this->id)
					->where('return_time',null)
					->count();
		return $b;
	}

	public function canBorrow(){
		$b = Borrow::where('book_id',$this->id)
					->where('return_time',null)
					->count();

		if ($this->number > $b) {
			return 1;
		}else{
			return 0;
		}
	}




}
