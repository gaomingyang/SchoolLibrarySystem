<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Squad;

class SeatController extends Controller
{
    public function create($id)
    {
        $squad = Squad::findOrFail($id);
        return view('admin.seat.create',compact('squad'));
    }


}
