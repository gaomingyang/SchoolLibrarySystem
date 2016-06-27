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
        $borrow_allowed_squads = explode(',',$system->borrow_allowed_squads);
        return view('admin.system.index',compact('system','squads','borrow_allowed_squads'));
    }


    public function update(Request $request,$id)
    {
        //还应增加设置：最少可借1本。最少1天。
        $borrow_allowed_squads = $request->borrow_allowed_squads;
        $borrow_allowed_squads_str = implode(',',$borrow_allowed_squads);

        $data = $request->all();
        $data['borrow_allowed_squads'] = $borrow_allowed_squads_str;

        $system = System::first();
        try {
            $update=$system->update($data);
        } catch (Exception $e) {
            Session::flash('error','设置失败！');
            return Redirect::back()->withInput();
        }

        Session::flash('success', '设置成功!');
        return Redirect::back()->withInput();
    }


}
