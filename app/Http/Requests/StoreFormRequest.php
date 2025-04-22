<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'title' => 'required|string|min:5|max:100',
                'short_description' => 'required|string|min:10|max:200',
                'description' => 'required|string|min:20|max:700',
                'file' => 'required|image|max:2048',
                'categories' => 'required',
            ];
        }
        return [
            'title' => 'required|string|min:5|max:100',
            'short_description' => 'required|string|min:10|max:200',
            'description' => 'required|string|min:20|max:700',
            'file' => 'image|max:2048',
            'categories' => 'required',
        ];
    }
}
