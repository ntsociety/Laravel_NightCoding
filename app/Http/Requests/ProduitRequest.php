<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'prix' => ['required', 'numeric'],
            'category_id' => ['nullable', 'integer'],

        ];

        if ($this->getMethod() == "POST") {
            $rules += ['image' => ['required', 'image', 'mimes:jpeg,jpg,png']];
        }
        if ($this->getMethod() == "PUT") {
            $rules += ['image' => ['nullable', 'image', 'mimes:jpeg,jpg,png']];
        }

        return $rules;
    }
    public function message()
    {
    }
}
