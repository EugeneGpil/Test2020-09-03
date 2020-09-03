<?php

namespace App\Http\Controllers\Document\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDocumentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'document' => 'required|array',
            'document.payload' => 'required|array',
        ];
    }
}
