<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Borrow;
use App\Student;
use App\System;
use Redirect,DB;
class FrontController extends Controller
{

    public function index()
    {
        return view('front.index');
    }

    //search books
    public function search(Request $request)
    {
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
            $students = Student::withoutGlobalScopes()->where('name','like','%'.$keyword.'%')->get();
            $student_number = count($students);
            return view('front.searchresults',compact('books','keyword','book_number','students','student_number'));
        }
        exit;
    }

    //ranking list
    public function ranks()
    {
        $fromdate = System::first()->rank_from_date ?  System::first()->rank_from_date : '2016-01-01';


        //students
        // $studentRank = Borrow::all()->groupBy('student_id')->orderBy('')->get();
        $students = DB::table('borrow')->select('student_id',DB::raw('count(*) as total'))->groupBy('student_id')->where('borrow_time','>',$fromdate)->orderBy('total','desc')->limit(10)->get();
        foreach ($students as $key => $s) {
            $student = Student::withoutGlobalScopes()->findOrFail($s->student_id);
            $s->student = $student;
        }


        //books && booksort

        $books = DB::table('borrow')->select('book_id',DB::raw('count(*) as total'))->groupBy('book_id')->where('borrow_time','>',$fromdate)->orderBy('total','desc')->limit(20)->get();
        foreach ($books as $key => $b) {
            $b->book = Book::withTrashed()->findOrFail($b->book_id);
        }


        //bookCategories
        $booklists = DB::table('borrow')->select(DB::raw('distinct book_id'))->where('borrow_time','>',$fromdate)->get();
        $bookCategories = array();
        $keys = array();
        $sum = 0;

        foreach ($booklists as $key => $b) {
            $bookinfo = Book::withTrashed()->findOrFail($b->book_id);
            $category_id =$bookinfo->category_id;

            if (!in_array($category_id, $keys)) {
                $keys[]=$category_id;
                // $bookCategories[] = array('category_id'=>$category_id,'count'=>1);
                $bookCategories[$category_id]['name'] = $bookinfo->category->name;
                $bookCategories[$category_id]['number'] = 1;
            }else{
                $bookCategories[$category_id]['number'] += 1;
            }
            $sum +=1;

        }

       //加上百分比
       foreach ($bookCategories as $key => $c) {
            $bfb=round($c['number']/$sum,2)*100;
            $bookCategories[$key]['percentage'] = $bfb.'%';
        }
        // $bookCategories = usort($bookCategories);
        // echo "<pre>";
        // print_r($bookCategories);
        // echo "</pre>";
        // exit;
        return view('front.ranks',compact('fromdate','students','books','bookCategories'));
    }

    public function studentrank()
    {
        $students = DB::table('borrow')->select('student_id',DB::raw('count(*) as total'))->groupBy('student_id')->orderBy('total','desc')->get();
        foreach ($students as $key => $s) {
            $student = Student::findOrFail($s->student_id);
            $s->student = $student;
        }
        return view('front.ranks',compact('students'));


    }

    public function bookrank()
    {
        $books = DB::table('borrow')->select('book_id',DB::raw('count(*) as total'))->groupBy('book_id')->orderBy('total','desc')->get();
        foreach ($books as $key => $b) {
            $b->book = Book::findOrFail($b->book_id);
        }
        return view('front.ranks',compact('books'));
    }

    public function updatefromdate(Request $request)
    {
        $fromdate = $request->fromdate;
        $system = System::first();
        $update = $system->update(['rank_from_date'=>$fromdate]);
        if($update){
            return 'success';
        }else{
            return null;
        }
    }




}
