<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grade;
use App\Squad;

use Redirect,Session;

class SquadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $grades = Grade::all();
        return view('admin.grade.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all();
        return view('admin.squad.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $c=Squad::create($data);
        if ($c) {
            Session::flash('success', '新增班级成功!');
            return Redirect::to('admin/grade');
        } else {
            return Redirect::back()->withInput()->withErrors('新增失败！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $squad = Squad::findOrFail($id);
        return view('admin.squad.profile',compact('squad'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $squad = Squad::findOrFail($id);
        $grades = Grade::all();
        return view('admin.squad.edit',compact('squad','grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $squad = Squad::findOrFail($id);
        try {
            $squad->update($request->all());
        } catch (Exception $e) {
            Session::flash('error', '更新班级失败!');
            return Redirect::back()->withInput();
        }
        Session::flash('successc', '更新成功！');
        return Redirect::to('admin/grade');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $squad = Squad::find($id);

        if(count($squad->students) > 0){
            Session::flash('error', '班级内还有学生，无法删除班级!');
            return Redirect::back();
        }


        try {
            $squad->delete();
        } catch (Exception $e) {
            Sesion::flash('error', '删除班级失败!');
            return Redirect::back();
        }
        Session::flash('successc','删除成功');
        return Redirect::to('admin/grade');
    }
}
