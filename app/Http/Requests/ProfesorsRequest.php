<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfesorsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'min:3|max:120|required',
            'email'     => 'min:4|max:120|required|unique:Users',
            'password'  => 'min:6|max:120|required'
            //
        ];
    }
}
