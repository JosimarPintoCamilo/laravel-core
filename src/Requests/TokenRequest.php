<?php

namespace JosimarCamilo\LaravelCore\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
            'token_name' => 'required|string'
        ];
    }
}