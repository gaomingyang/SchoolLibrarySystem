<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use App\Borrow;
use App\System;
use Redirect,Session,Validator;

class StudentController extends Controller
{
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('front.student.profile',compact('student'));
    }

    //根据班级列出学生
    //ajax json
    public function stuBySquad($squad_id){
        $students = Student::where('squad_id',$squad_id)->orderBy('name','asc')->get();
        if (!empty($students)) {
            return $students;
        }else{
            return 'null';
        }
    }

    public function ajaxUpdateGender(Request $request)
    {
        $id = $request->id;
        $gender = $request->gender;

        $student = Student::findOrFail($id);
        $update=$student->update(['gender'=>$gender]);
        if ($update) {
            return 'success';
        }else{
            return null;
        }
    }

    public function checkallow($id)
    {
        //监测 1.是否在黑名单。 2.是否借书超过2本。
        $student = Student::findOrFail($id);
        $borrowed_number = $student->borrow->where('return_time',null)->count();
        $borrow_number_limit = System::first()->borrow_number_limit;

        //返回可用额度（本数）
        // if ($borrowed_number < $borrow_number_limit) {
            return $borrow_number_limit - $borrowed_number;
        // }else{
            // return 'deny';
        // }
    }

    /*
     |--------------------------------------------------------------------------
     | ajax return books
     |--------------------------------------------------------------------------
     |
     */
    public function returnbooks($id)
    {
        $result = array();
        $student = Student::findOrFail($id);
        $books = $student->borrow->where('return_time',null);

        $result['user'] = $student;
        $booklist =array();
        foreach ($books as $key => $book) {
            $book['name'] = $book->book->name;
            $booklist[] =$book;
        }
        $result['books'] = $booklist;

        return $result;
    }








}
