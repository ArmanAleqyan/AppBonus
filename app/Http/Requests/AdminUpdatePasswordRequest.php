<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdatePasswordRequest extends FormRequest
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
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|confirmed',
            'newpassword_confirmation' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'oldpassword.required' => 'Campo obligatorio de contraseña antigua',
            'newpassword.required' => 'Nuevo campo obligatorio de contraseña',
            'newpassword.min6' => 'La nueva contraseña debe tener 6 caracteres',
            'newpassword.confirmed' => 'Las contraseñas no coinciden',
            'newpassword_confirmation.required' => 'Campo obligatorio de confirmación de contraseña',

        ];
    }
}
