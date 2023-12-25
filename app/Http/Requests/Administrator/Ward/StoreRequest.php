<?php

namespace App\Http\Requests\Administrator\Ward;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'gso_id'      => ['bail', 'required', 'unique:wards,gso_id,NULL,id,deleted_at,NULL'],
            'name'        => ['bail', 'required', 'unique:wards,name,NULL,id,deleted_at,NULL'],
            'province_id' => ['required', 'exists:provinces,id'],
            'district_id' => ['required', 'exists:districts,id']
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
            'gso_id'      => attr('ward.gso_id'),
            'name'        => attr('ward.name'),
            'province_id' => attr('province.name'),
            'district_id' => attr('district.name'),
        ];
    }
}
