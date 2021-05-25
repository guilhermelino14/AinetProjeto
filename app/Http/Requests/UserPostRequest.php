<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
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
            'name' =>         'required',
            'endereco' =>        'required',
            'nif' =>       'required|digits:9',
            'email' => [
                'required',
                'email',
            ],
            'password' =>       'nullable|min:8|confirmed',
            'img' =>       'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo "Nome" tem que ser preenchido',
            'endereco.required' => 'Campo "Endereco" tem que ser preenchido',
            'nif.required' => 'Campo "NIF" tem que ser preenchido',
            'email.required' => 'Campo "Email" tem que ser preenchido',
        ];
    }
}
