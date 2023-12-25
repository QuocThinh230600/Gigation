<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function rules()
    {
        return [
            'email'            => ['required', 'email', 'unique:users'],
            'password'         => ['bail', 'required', 'min:6', 'confirmed'],
            'full_name'        => ['required'],
            'phone'            => ['required'],
            'accept_condition' => ['required'],
            'captcha'          => ['required', 'captcha'],
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function messages()
    {
        return [
            //
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attributes()
    {
        return [
            'email'            => attr('register.email'),
            'password'         => attr('register.password'),
            'full_name'        => attr('register.full_name'),
            'phone'            => attr('register.phone'),
            'accept_condition' => attr('register.accept_condition'),
            'captcha'          => attr('register.captcha'),
        ];
    }
}
