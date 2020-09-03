<?php

namespace App\Http\Controllers\Document\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'page' => 'required|int',
            'perPage' => 'int|between:1,1000'
        ];
    }
}
