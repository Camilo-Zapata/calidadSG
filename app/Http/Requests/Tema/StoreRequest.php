<?php

namespace App\Http\Requests\Tema;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nombre" => 'required|min:3',
            "tipo" => 'required|min:3',
            "objetivo" => 'required|min:3',
            "facilitador_nombre"  => 'required|min:3',
            "facilitador_cargo"  => 'required|min:3',
        ];
    }
}