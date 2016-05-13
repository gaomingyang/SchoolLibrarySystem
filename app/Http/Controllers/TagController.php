<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tag;
use Session,Redirect,Validator,DB;
// use App\Http\Requests\MarkForm;

class TagController extends Controller
{
    public function show($id)
    {
        $tag=Tag::findOrFail($id);
        return view('front.tag.profile',compact('tag'));
    }

}
