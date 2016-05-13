<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Borrow;
use App\Student;
use Carbon\Carbon;
use Redirect;

class BorrowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function borrowlog()
    {
        $borroweds = Borrow::orderBy('id', 'desc')->paginate(50);
        $number = $borroweds->count();
        $title = '借书记录';
    	return view('admin.borrow.index',compact('borroweds','title','number'));
    }

    public function borrowed()
    {
        $borroweds = Borrow::where('return_time',null)->orderBy('id', 'desc')->paginate(50);
        $number = $borroweds->count();
        $title = '借出书单';
    	return view('admin.borrow.index',compact('borroweds','number','title'));
    }

    public function returned()
    {
        $borroweds = Borrow::where('return_time','>','0000-00-00 00:00:00')->orderBy('return_time', 'desc')->paginate(50);
        $number = $borroweds->count();
        $title = '已还书单';
    	return view('admin.borrow.index',compact('borroweds','number','title'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
