<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class criarEstampaPostRequest extends FormRequest
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
            'nome' =>         'required',
            'descricao' =>        'required',
            'categoria' =>       'required',
            'imagem_url' =>       'nullable',
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'Campo "Nome" tem que ser preenchido',
            'descricao.required' => 'Campo "Descrição" tem que ser preenchido',
            'categoria.required' => 'Campo "Categoria" tem que ser preenchido',
        ];
    }
}
