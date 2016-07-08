<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{

    public function students()
    {
        // return $this->
    }

    public function squad()
    {
        return $this->belongsTo('App\Squad');
    }


}
