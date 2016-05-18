<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Borrow;
use App\Student;
use App\System;
use Carbon\Carbon;
use Redirect,Validator;

class BorrowController extends Controller
{

    public function create()
    {
        return view('front.borrow.create');
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'student_id' => 'required|numeric|max:5',
        //     'book_id'   => 'required',
        //     ]);

    //     $validator = Validator::make($request->all(), [
    //         'student_id' => 'required|numeric|max:5',
    //          'book_id'   => 'required',
    //    ]);
       //
    //     if ($validator->fails())
    //     {
    //         return Redirect::back()->withInput()->withErrors($validator);
    //     //    return redirect('/')->withInput()->withErrors($validator);
    //     }

        // $student_id = $request->student_id;
        $comment = $request->comment;
        $time = Carbon::now();
        $student = Student::findOrFail($request->student_id);

        $borrowArr = array();
        foreach ($request->book_id as $key => $book_id) {
            $borrowArr[] = new Borrow(['book_id'=>$book_id,'number'=>1,'comment'=>$comment,'borrow_time'=>$time]);
        }

        try {
            $student->borrow()->saveMany($borrowArr);
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors('增加失败');
        }



        // foreach ($book_ids as $book_id) {
        //    $borrow = new Borrow;
        //    $borrow->book_id = $book_id;
        //    $borrow->number = 1;
        //    $borrow->student_id = $request->student_id;
        //    $borrow->comment = $request->comment;
        //    $borrow->borrow_time = Carbon::now();
        //    $borrow->save();
        // }
       return view('front.borrow.success');
    }

    //还书界面
    public function back(){
        return view('front.borrow.return');
    }

    //学生个人还书界面
    public function student($id)
    {
        $student = Student::findOrFail($id);
        return view('front.borrow.student',compact('student'));
    }

    //do return
    public function doreturn(Request $request)
    {
         $id = $request->id;
        //  echo $id;
        //  exit;
         $record = Borrow::findOrFail($id);
         try {
             $record->return_time = Carbon::now();
             $record->save();
         } catch (Exception $e) {
             return 'fail';
         }
         return 'success';

    }

    public function borrowed()
    {
        $borroweds = Borrow::where('return_time',null)->orderBy('id', 'desc')->paginate(200);
        $number = $borroweds->count();

        // $today = date('Y-m-d');
        $period = System::first()->borrow_days_limit;

        // $stone = date('Y-m-d',"-$period days");
        // echo $stone;
        // $t = Carbon::now();
        // echo $t;

        $t =  new Carbon('-'.$period.' days');
        // echo $t->toDateString();
        $delayeds = Borrow::where('borrow_time','<=',$t)->where('return_time',null)->orderBy('borrow_time','asc')->get();
        // print_r($delayeds);
        
    	return view('front.borrow.borrowed',compact('borroweds','number','delayeds'));
    }

    public function returned(Request $request)
    {

        // if ($request->day == 'today') {
        //     $data = Carbon::
        // }else{
        //
        // }

        $borroweds = Borrow::where('return_time','>','0000-00-00 00:00:00')->orderBy('return_time', 'desc')->paginate(200);
        $number = $borroweds->count();
        $title = '已还书单';
    	return view('front.borrow.index',compact('borroweds','number','title'));
    }

    public function success(){
         return view('front.borrow.success');
    }
}
