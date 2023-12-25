<?php

namespace App\Http\Requests\Administrator\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $levels = array();
        foreach (level() as $level) {
            $levels[] = $level->id;
        }

        return [
            'email'     => ['bail', 'required', 'email', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password'  => ['required', 'confirmed', 'min:6'],
            'full_name' => ['required'],
            'phone'     => ['required'],
            'level'     => ['required', Rule::in($levels)],
            'role_id'   => ['required', 'exists:roles,id']
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
            'email'     => attr('user.email'),
            'password'  => attr('user.password'),
            'full_name' => attr('user.full_name'),
            'phone'     => attr('user.phone'),
            'role_id'   => attr('user.role'),
            'level'     => attr('user.level')
        ];
    }
}
