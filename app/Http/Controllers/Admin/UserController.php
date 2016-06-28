<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Validator,Redirect,Session,Hash;

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
            // 'password_confirmation'=>'required',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if (User::create($data)) {
            Session::flash('successc', '新增成功!');
            return Redirect::to('admin/user');
        }else{
            Session::flash('error', '新增失败!');
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
        $this->validate($request,[
            'name' => 'required',
            'email'=>'required|email',
        ]);

        $data = $request->all();


        if (!empty($data['password'])) {
            echo "have password";
            $data['password'] = Hash::make($data['password']);
        }

        try{
            User::find($id)->update($data);
            Session::flash('successc'   ,'更新成功!');
            return Redirect::back();
        } catch (\Exception $e){
            Session::flash('error','更新失败!');
            return Redirect::back()->withInput();
        }



    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (Exception $e) {
            return Redirect::back()->withErrors('删除失败');
        }
        Session::flash('successc','删除成功');
        return Redirect::to('admin/user');
    }

}
