<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChairRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'chairs' => ['required', 'array'],
            'chairs.*.id' => ['required', 'integer'],
            'chairs.*.hall_id' => ['required', 'integer'],
            'chairs.*.row' => ['required', 'integer'],
            'chairs.*.place' =>['required', 'integer'],
            'chairs.*.type' => ['required', 'string'],
        ];
    }
}
