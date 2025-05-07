<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            //
            'content' => 'required|string|min:3|max:500',
        ];
    }
    public function messages(): array
    {
        return [
            'content.required' => 'İçerik kısmı boş bırakılamaz.',
            'content.min' => 'Yorumunuz çok kısa.',
            'content.max' => 'Yorumunuz çok uzun.'

        ];
    }
    
}
