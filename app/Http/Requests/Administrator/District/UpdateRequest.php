<?php

namespace App\Http\Requests\Administrator\District;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'gso_id'      => ['bail', 'required', 'unique:districts,gso_id,' . $this->district . ',id,deleted_at,NULL'],
            'name'        => ['bail', 'required', 'unique:districts,name,' . $this->district . ',id,deleted_at,NULL'],
            'province_id' => ['required', 'exists:provinces,id']
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
            'gso_id'      => attr('district.gso_id'),
            'name'        => attr('district.name'),
            'province_id' => attr('province.name'),
        ];
    }
}
