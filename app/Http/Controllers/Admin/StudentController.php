<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grade;
use App\Squad;
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
        $squads = Squad::all();
        return view('admin.student.create',compact('squads'));
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
        $student = Student::withoutGlobalScopes()->findOrFail($id);
        return view('admin.student.profile',['student'=>$student]);
    }
    public function edit($id)
    {
        $student = Student::withoutGlobalScopes()->findOrFail($id);
        $squads = Squad::all();
        return view('admin.student.edit',compact('student','squads'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::withoutGlobalScopes()->findOrFail($id);
        $data = $request->all();
        $update=$student->update($data);
        if ($update) {
            Session::flash('successc', '更新成功！');
            return Redirect::to('admin/student/'.$id);
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        $student = Student::withoutGlobalScopes()->findOrFail($id);
        try {
            $student->delete();
        } catch (Exception $e) {
            return Redirect::back()->with('error', '删除失败');
        }
        Session::flash('successc', '删除成功！');
        return Redirect::to('admin/student');
    }

    //回收站
    public function trashed()
    {
        $students = Student::withoutGlobalScopes()->onlyTrashed()->get();
        $number = count($students);
        return view('admin.student.trashed',compact('students','number'));
    }

    public function restore($id)
    {
        if (Student::onlyTrashed()->where('id',$id)->restore()) {
            Session::flash('successc','恢复成功！');
            return Redirect::to('admin/student/trashed');
        }else{
            echo "fail";
        }
    }

    public function rise()
    {
        $grades = Grade::orderBy('order','asc')->get();
        return view('admin.student.rise.create',compact('grades'));
    }

    public function dorise(Request $request)
    {
        $students=$request->students;
        $newsquad=$request->newsquad;
        $graduate=$request->graduate;

        if ($request->newsquad) {
            $do = Student::whereIn('id',$students)->update(['squad_id'=>$request->newsquad]);
            if($do >0 && $do == count($students)){
                Session::flash('successc','操作完成');
                return Redirect::back();
            }else{
                Session::flash("error","操作失败");
                return Redirect::back();
            }
        }elseif($request->graduate){
            $time = Carbon::now();
            //DB::table('countries')->whereIn('id', [1, 2])->update(['code' => 'AD']);
            $updateArr = ['graduated'=>1,'graduated_at'=>$time];
            // $do = DB::table('students')->whereIn('id', $students)->update($updateArr);
            $do = Student::whereIn('id', $students)->update($updateArr);
            if($do >0 && $do == count($students)){
                Session::flash('successc','操作完成');
                return Redirect::back();
            }else{
                Session::flash("error","操作失败");
                return Redirect::back();
            }
        }else{
            Session::flash('error','出错了！');
            return Redirect::back();
        }

    }

    public function graduated()
    {
        $students = Student::withoutGlobalScopes()->where('graduated',1)->orderBy('graduated_at','desc')->paginate(50);
        $number = Student::withoutGlobalScopes()->where('graduated',1)->count();
        return view('admin.student.rise.graduated',['students'=>$students,'number'=>$number]);
    }

    public function ungraduated($id)
    {
        $student= Student::withoutGlobalScopes()->findOrFail($id);
        if (!$student) {
            Session::flash('error','找不到此学生！');
            return ;
        }

		$student->update(['graduated'=>0,'graduated_at'=>null]);

        if (Student::onlyTrashed()->where('id',$id)->restore()) {
            Session::flash('successc','恢复成功！');
            return Redirect::to('admin/student/trashed');
        }else{
            echo "fail";
        }

    }



}
