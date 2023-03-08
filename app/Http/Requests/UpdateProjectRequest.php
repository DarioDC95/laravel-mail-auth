<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => ['required', Rule::unique('projects')->ignore($this->project), 'max:150'],
            'content' => ['nullable'],
            'type_id' => ['nullable', 'numeric', 'exists:types,id'],
            'technologies' => ['nullable', 'exists:technologies,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Il titolo deve essere unico',
            'title.max' => 'Il titolo deve avere al massimo :max caratteri',
            'type_id.numeric' => 'la tipologia deve essere obbligatoriamente un numero',
            'type_id.exists' => 'la tipologia selezionata non è valida',
            'technologies.exists' => 'la tecnologia selezionata è invalida'
        ];
    }
}
