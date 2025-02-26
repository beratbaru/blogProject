<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:100|unique:users,email,' . $this->user()->id,
            'password' => 'required|string|min:6'
        ];
    }
    public function messages(): array
    {
        return[
            'name.min' => 'İsim en az 4 karakter içermeli.',
            'name.max' => 'İsim en fazla 255 karakter olabilir.',
            'email.email' => 'Geçerli bir mail adresi girdiğinizden emin olun.',
            'email.max' => 'Daha kısa bir mail adresi giriniz.',
            'email.unique' => 'Bu mail adresi zaten kullanılıyor.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.',

            'name.required' => 'İsim kısmı boş bırakılamaz.',
            'email.required' => 'Mail kısmı boş bırakılamaz.',
            'password.required' => 'Şifre kısmı boş bırakılamaz.'
        ];
    }
}
