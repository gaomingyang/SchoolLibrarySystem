<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\System;
use App\Squad;

use Session,Redirect;
class SystemController extends Controller
{

    public function index()
    {
        $system = System::first();
        $squads = Squad::all();
        return view('admin.system.index',compact('system','squads'));
    }


    public function update(Request $request,$id)
    {
        //最少可借1本。
        //最少1天。

        $data = $request->all();
        $system = System::first();
        try {
            $update=$system->update($data);
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors('设置失败');
        }

        Session::flash('success', '设置成功!');
        return Redirect::back()->withInput();
    }


}
