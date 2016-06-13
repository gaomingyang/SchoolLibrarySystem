<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Category;
use App\Tag;
use Session,Redirect,Validator,DB;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(50);
        // $books = Book::withTrashed()->get();
        // $books = Book::all()->paginate(100);
        return view('admin.book.index',compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.book.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->name = trim($request->name);
        if (empty($request->name)) {
            return Redirect::back()->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = $request->all();
        $tags = $request->tags;

        $c=Book::create($data);
        if ($c) {
            if (!empty($tags)) {

                $setTags = Tag::setBookTags($c->id,$tags);
                // if (!$setTags) {
                //     return Redirect::back()->withInput()->withErrors('新增图书成功，但设置标签失败！');
                // }
            }

            Session::flash('success', '新增成功!');
            // return redirect('admin/book/'.$c->id);
            //return Redirect::to('admin/book/'.$c->id);
            return Redirect::to('admin/book/');
        } else {
            return Redirect::back()->withInput()->withErrors('新增失败！');
        }
    }

    public function show($id)
    {
        $book=Book::findOrFail($id);
        return view('admin.book.profile',compact('book'));
    }

    public function edit($id)
    {
        return view('admin.book.edit',['book'=>Book::findOrFail($id),'categories'=>Category::all()] );
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->all();

        // $picture = $request->file('picture');
        // if ($picture) {
        //     $p=new Photo;
        //     $name = $p->saveImage($picture);
        //     $data['picture'] = $name;

        //     if (!empty($g->picture) && Storage::exists('photos/'.$g->picture)) {
        //         Storage::delete('photos/'.$g->picture);
        //     }
        // }

        $tags = $request->tags;

        //
        // $a = Tag::TagStringsToIds($tags);
        // print_r($a);
        // exit;

        // Tag::setBookTags($id,$tags);
        // $book->tags()->sync([1,2,6]);
        // exit;


        try {
            $update=$book->update($data);
            if (!empty($tags)){
                $setTags = Tag::setBookTags($id,$tags);
            }
        } catch (Exception $e) {
            return Redirect::back()->withInput()->withErrors('更新失败');
        }

        Session::flash('success', '更新成功！');
        return Redirect::to('admin/book/'.$id);

    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        try {
            // if (!empty($book->picture) && Storage::exists('photos/'.$book->picture)) {
            //     Storage::delete('photos/'.$book->picture);
            // }
            $tags = $book->tags;
            DB::table('booktags')->where('book_id', '=', $id)->delete();
            foreach ($tags as $tag) {
                Tag::tidyTagCount($tag->id);
            }
            $book->delete();
            // return redirect('/');
        } catch (Exception $e) {
            return Redirect::back()->with('error', '删除失败');
        }
        Session::flash('successc', '删除成功！');
        return Redirect::to('admin/book');
    }

    //回收站
    public function trashed()
    {
        $books = Book::onlyTrashed()->get();
        return view('admin.book.trashed',compact('books'));
    }

}
