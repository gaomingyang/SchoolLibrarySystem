<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;
use Session,Redirect,Validator,DB;
// use App\Http\Requests\MarkForm;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->paginate(50);
        return view('admin.tag.index',compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $request->name = trim($request->name);
        if (empty($request->name)) {
            return Redirect::back()->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = $request->all();
        $c=Tag::create($data);
        if ($c) {
            Session::flash('success', '创建成功!');
            return Redirect::to('admin/tag');
        } else {
            return Redirect::back()->withInput()->withErrors('创建失败！');
        }
    }

    public function show($id)
    {
        $tag=Tag::findOrFail($id);
        return view('admin.tag.profile',compact('tag'));
    }


    public function edit($id)
    {
        $tag=Tag::findOrFail($id);
        return view('admin.tag.edit',compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $data = $request->all();
        $update=$tag->update($data);
        if ($update) {
            Session::flash('flash_message', '更新成功！');
            return Redirect::to('admin/tag');
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        try {
            DB::table('booktags')->where('tag_id', '=', $id)->delete();
            $tag->delete();
        } catch (Exception $e) {
            return Redirect::back()->with('error', '删除失败');
        }
        Session::flash('flash_message', '删除成功！');
        return Redirect::to('admin/tag');
    }

}
