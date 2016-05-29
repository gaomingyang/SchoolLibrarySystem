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
        $validator = Validator::make($request->all(), [
            'name' => 'user.name.required',
            'email'=>'required|email',
            'password'=>'required',
            'password_confirmation'=>'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if (User::create($request)) {
            Session::flash('success', '新增成功!');
            return Redirect::to('admin/category');
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

    public function update()
    {

    }

    public function destroy()
    {

    }
    
}
