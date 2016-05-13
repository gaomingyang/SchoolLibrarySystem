<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

use DB;

class Tag extends Model
{
    protected $table="tags";
    protected $fillable=['id','name'];
    public $timestamps=false;

    public function books()
    {
        return $this->belongsToMany('App\Book','booktags');
    }


    //获取所有标签
    public static function getAllTagModel()
    {
        return self::orderBy('count','desc')->get();
    }

    //把标签model转换成['xxx','xxx']格式
    public static function TagModelsToString($tags)
    {
        $tag = '';
        if (!empty($tags)) {
            $tag = "[";
            foreach ($tags as $k => $v) {
                $tag .= "'$v->name',";
            }
            $tag = trim($tag, ',');
            $tag .= ']';
        }
        return $tag;
    }

    /**
    * 获取标签插件所需得列表数据
    * @return null|string
    */
    public static function getTagsString()
    {
        $tags = self::getAllTagModel();
        return !empty($tags) ? self::TagModelsToString($tags) : null;
    }

    //把字符串改为id
    public static function TagStringsToIds($tags)
    {
        if (!empty($tags)) {
            $tagsArr = explode(',',$tags);
        }
        if (!empty($tagsArr)) {
            $tagIdArr = array();
            foreach ($tagsArr as $k => $v) {
                $name = trim($v);
                $tag = self::where('name',$name)->first();
                if ($tag) {
                    //如果存在
                    $tagIdArr[] = $tag->id;
                }else{
                    //如果不存在
                    $tagIdArr[] = self::insertGetId(['name' => $name, 'count' => 1]);
                }
            }
            return $tagIdArr;
        }
    }

    //设置图书的标签
    //book_id integer
    //tags string： xxx,xxx
    public static function setBookTags($book_id,$tags)
    {
        $tagIdArr = self::TagStringsToIds($tags);
        $book = Book::findOrFail($book_id);
        $book->tags()->sync($tagIdArr);

        foreach ($tagIdArr as $id) {
            self::tidyTagCount($id);
        }
    }

    public static function tidyTagCount($id){
        $count = DB::table('booktags')->where('tag_id', '=', $id)->count();
        Tag::where('id',$id)->update(['count'=>$count]);
    }

    //热门标签
    public static function hotTags($limit)
    {
       return self::orderBy('count', 'DESC')->limit($limit)->get();
    }

}
