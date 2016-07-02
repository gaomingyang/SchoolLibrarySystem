<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Tag;
use Session,Redirect,Validator;

class BookController extends Controller
{
    //图书列表
    public function index()
    {
        $book_number=Book::count();
        // $books = Book::all()->paginate(10);
        $books = Book::orderBy('id', 'desc')->paginate(30);
        $tags = Tag::hotTags(10);
    	// $books = Book::all()->paginate(50);
    	return view('front.book.books',compact('books','book_number','tags'));
    }

    //图书详情
    public function show($id)
    {
    	$book=Book::withTrashed()->findOrFail($id);
        return view('front.book.book',compact('book'));
    }

    public function borrowinfo($keyword)
    {

        $allbooks = Book::withTrashed()->where('id','=',$keyword)->orwhere('name','LIKE','%'.$keyword.'%') ->get();
        $books = array();
        foreach ($allbooks as $key => $book) {
            // print_r($book->id);
            // echo ":";
            $wr = $book->waitReturn();
            // print_r($wr);

            if (count($wr) >= 1 ) {
                $books[] = $book;
            }
            // echo "<hr/>";
        }
        return view('front.book.borrowinfo',compact('books'));
    }


    //未登记图书 登记并借出
    public function ajaxstore(Request $request)
    {
        $request->name = trim($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        $c = new Book;
        $c->name = $request->name;
        if ($c->save()) {
            return $c->id;
        }else{
            return 'fail';
        }
    }

    //图书增加时监测书名重复
    public function ajaxRepeat(Request $request)
    {
        $name = $request->name;
        $book = Book::where('name',$name)->first();
        if ($book) {
            return 'repeat';
        }else{
            return '';
        }
    }

    //列出指定名称图书
    public function name($name)
    {
        $books = Book::where('name',$name)->paginate(20);
        $book_number=count($books);
        return view('front.book.books',compact('books','book_number'));
    }

    //get info by id
    //ajax json
    // used for create borrow to add book by id.
    public function searchbyid($id)
    {
        $book = Book::find($id);
        //1.the number is exist 2.can be borrowed(loanable)

        if (!$book) {
            return 'empty';
        }

        if ($book->canBorrow()) {
            return $book->toJson();
        }else{
            return 'borrowed';
        }

    }

    //search books by keyword
    //ajax json
    //only show those can  be borrowed
    public function searchbykw($keyword)
    {
        if (empty($keyword)) {
            return null;
        }
        $books = Book::where('name','LIKE','%'.$keyword.'%')->orwhere('id','=',$keyword)->get();

        // foreach ($results as $key => $b) {
        //     if ($b->canBorrow() == 0) {
        //
        //     }
        // }
        return $books->toJson();
    }


}
