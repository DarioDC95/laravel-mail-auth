<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:types', 'max:100'],
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'name.unique' => 'Il nome deve essere unico',
            'name.max' => 'Il nome deve avere al massimo :max caratteri',
        ];
    }
}
