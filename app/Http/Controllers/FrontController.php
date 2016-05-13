<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Borrow;
use App\Student;
use Redirect;
class FrontController extends Controller
{
	//前台主页
    public function index(){
        return view('front.index');
    }

    //搜索图书
    //返回结果页
    public function search(Request $request){
        $keyword = $request->keyword;

        if(empty($keyword)){
            return view('front.warning',['title'=>'注意','content'=>'未输入搜索关键词！']);
        }

        $books = Book::where('name','LIKE','%'.$keyword.'%')->orwhere('id','=',$keyword)->paginate(200);
        $book_number=count($books);
        if (preg_match("/^\d+$/",$keyword))
        {
            //输入数字，只可能是书id或者书名。
            return view('front.searchresults',compact('books','keyword','book_number'));
        }else
        {
            // echo "123";
            //非数字，可能包含学生姓名。
            $students = Student::where('name','like','%'.$keyword.'%')->get();
            $student_number = count($students);
            return view('front.searchresults',compact('books','keyword','book_number','students','student_number'));

        }

        exit;



    }










}
