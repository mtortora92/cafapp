<?php

namespace cafapp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidator extends FormRequest
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
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Inserire nome',
            'nome.string' => 'Inserire nome',
            'nome.max' => 'Inserire nome',
            'cognome.required' => 'Inserire cognome',
            'cognome.string' => 'Inserire cognome',
            'cognome.max' => 'Inserire cognome',
            'username.required' => 'Inserire username',
            'username.string' => 'Inserire username',
            'username.max' => 'Inserire username',
            'username.unique' => "L'username inserito è già registrato",
            'password.confirmed' => "Le password non corrispondono",
            'password.required' => "La password deve avere almeno 6 caratteri",
            'password.min' => "La password deve avere almeno 6 caratteri",
        ];
    }
}
