<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditPostRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
            ],
            'tipo' => 'required',
            'password' =>       'nullable',
            'bloqueado' => 'required',
            'foto_url' =>       'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo "Nome" tem que ser preenchido',
            'email.required' => 'Campo "Email" tem que ser preenchido',
            'password.required' => 'Campo "Password" tem que ser preenchido',
            'bloqueado.required' => 'Campo "Bloqueado" tem que ser preenchido',
        ];
    }
}
