<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı boş bırakılamaz.',
            'name.string' => 'İsim yalnızca metin içermelidir.',
            'name.max' => 'İsim en fazla 255 karakter olabilir.',
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.max' => 'E-posta en fazla 255 karakter olabilir.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'password.required' => 'Şifre alanı boş bırakılamaz.',
            'password.string' => 'Şifre yalnızca metin içermelidir.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',
            'password.confirmed' => 'Şifreler eşleşmiyor.',
            'password.confirmed.required' => 'Şifre tekrarı alanı boş bırakılamaz.',
        ];
    }
}
