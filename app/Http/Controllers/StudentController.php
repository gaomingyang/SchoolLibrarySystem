<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use Redirect,Session,Validator;

class StudentController extends Controller
{
    //根据班级列出学生
    //ajax json
    public function stuByGrade($grade_id){
        $students = Student::where('grade_id',$grade_id)->orderBy('name','asc')->get();
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

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('front.student.profile',compact('student'));
    }
















}
