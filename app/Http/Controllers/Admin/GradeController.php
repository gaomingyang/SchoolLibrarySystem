<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grade;
use App\Student;
use Carbon\Carbon;
use Redirect,Session,Validator,DB;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $grades = DB::select('select * from grades order by convert(name using gb2312) asc');
        // $grades = DB::select("select * from grades order by convert(name,'gbk','utf8') asc");
        //$grades = Grade::orderBy('id', 'desc')->paginate(30);
        $grades = Grade::all();
        return view('admin.grade.index',compact('grades'));
    }

    public function create()
    {
        return view('admin.grade.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $c=Grade::create($data);
        if ($c) {
            Session::flash('success', '新增成功!');
            return Redirect::to('admin/grade/');
        } else {
            return Redirect::back()->withInput()->withErrors('新增失败！');
        }
    }

    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        return view('admin.grade.profile',compact('grade'));
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        return view('admin.grade.edit',compact('grade'));
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        try {
            $grade->update($request->all());
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
        Session::flash('successc', '更新成功！');
        return Redirect::to('admin/grade');
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);

        if(count($grade->squads) > 0){
            Session::flash('error', '此年级内还有班级，无法删除年级!');
            return Redirect::back();
        }

        try {
            $grade->delete();
        } catch (Exception $e) {
            return Redirect::back()->withErrors('删除失败');
        }
        Session::flash('successc','删除成功');
        return Redirect::to('admin/grade');
    }

    public function trashed()
    {
        $grades = Grade::onlyTrashed()->get();
        return view('admin.grade.trashed',compact('grades'));
    }

    public function rise()
    {
        $grades = Grade::orderBy('order','asc')->get();
        return view('admin.grade.rise.create',compact('grades'));
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

    public function seattable_create($id)
    {
        $grade = Grade::findOrFail($id);
        return view('admin.grade.seattable.create',compact('grade'));
    }

}
