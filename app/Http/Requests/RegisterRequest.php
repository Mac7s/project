<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends LoginRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
                            'name'=>['required'],
                            'number'=>['required','digits:11','starts_with:09','unique:users'],
                            'password'=>['required','confirmed'],
                        ]);
    }

  
    
}
