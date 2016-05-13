<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Response;

class MarkForm extends AdminForm{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}
