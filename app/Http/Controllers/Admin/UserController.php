<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Validator,Redirect,Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
    	return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'user.name.required',
        //     'email'=>'required|email',
        //     'password'=>'required',
        //     'password_confirmation'=>'required',
        // ]);
        //
        // if ($validator->fails()) {
        //     return Redirect::back()->withInput()->withErrors($validator);
        // }
        //或是下面这种方式
        $this->validate($request,[
            // 'name' => 'user.name',
            'name' => 'required',
            'email'=>'required|email',
            'password'=>'required',
            'password_confirmation'=>'required',
        ]);

        if (User::create($request->all())) {
            Session::flash('success', '新增成功!');
            return Redirect::to('admin/user');
        }else{
            Session::flash('success', '新增失败!');
            return Redirect::back()->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (Exception $e) {
            return Redirect::back()->withErrors('删除失败');
        }
        Session::flash('flash_message','删除成功');
        return Redirect::to('admin/user');
    }

}
