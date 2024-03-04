<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'oldpass' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'oldpass.required' => 'Old password is required.',
            'oldpass.string' => 'Old password must be a string type.',

            'password.required' => 'New password is required.',
            'password.string' => 'New password must be a string type.',
            'password.min:8' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirm password does not match.',

            'password_confirmation.max' => 'Confirmation password is required.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'oldpass' => 'old password',
            'password' => 'new password',
            'password_confirmation' => 'confirmation password',
        ];
    }
}
