<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grade;
use App\Student;
use Redirect,Session,Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $student_number = Student::count();
        $students = Student::orderBy('id', 'desc')->paginate(40);
        return view('admin.student.index',compact('students','student_number'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('admin.student.create',compact('grades'));
    }

    public function store(Request $request)
    {

        $request->name = trim($request->name);
        if (empty($request->name)) {
            return Redirect::back()->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:10',
            // 'grade_id' => 'required|integer|',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        $data = $request->all();
        $c=Student::create($data);
        if ($c) {
            Session::flash('success', '新增成功!');
            // return redirect('book/'.$c->id);
            //return Redirect::to('admin/book/'.$c->id);
            return Redirect::to('admin/student/');
        } else {
            return Redirect::back()->withInput()->withErrors('新增失败！');
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.profile',['student'=>Student::findOrFail($id)]);
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $grades = Grade::all();
        return view('admin.student.edit',compact('student','grades'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->all();
        $update=$student->update($data);
        if ($update) {
            Session::flash('flash_message', '更新成功！');
            return Redirect::to('admin/student/'.$id);
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        try {
            $student->delete();
        } catch (Exception $e) {
            return Redirect::back()->with('error', '删除失败');
        }
        Session::flash('flash_message', '删除成功！');
        return Redirect::to('admin/student');
    }

    //回收站
    public function trashed()
    {
        $students = Student::onlyTrashed()->get();
        $number = count($students);
        return view('admin.student.trashed',compact('students','number'));
    }

    public function restore($id)
    {
        if (Student::onlyTrashed()->where('id',$id)->restore()) {
            Session::flash('flash_message','恢复成功！');
            return Redirect::to('admin/student/trashed');
        }else{
            echo "fail";
        }
        
    }



}
