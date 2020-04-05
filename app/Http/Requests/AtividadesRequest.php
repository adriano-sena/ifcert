<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadesRequest extends FormRequest
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
            'titulo' => 'required',
            'subTitulo' => 'required',
            'descricao' => 'required|max:240',
            'mediador' => 'required',
            'cargaHoraria' => 'required',
            'qtd_vagas' => 'required',
            'local' => 'required',
            'data' => 'required|after:tomorrow',

        ];
    }

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo dever possuir no máximo :max caracteres '
        ];
    }
}
