<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Squad;
use App\Seat;

class SeatController extends Controller
{
    public function create($id)
    {
        $squad = Squad::findOrFail($id);
        return view('admin.seat.create',compact('squad'));
    }

    public function store($id,Request $request)
    {
		$squad = Squad::findOrFail($id);
		$squad->seat()->create([
			''=>'',
		]);
    }

    public function edit($id)
	{
		$squad = Squad::findOrFind($id);
		//$seat = Squad::find($id)->seat()->first();
		return view('admin.seat.edit',compact('squad'));
    }

    


}
