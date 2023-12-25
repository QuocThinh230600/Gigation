<?php

namespace App\Http\Requests\Administrator\Language;

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
        $format_dates = array();
        foreach (format_date() as $format_date) {
            $format_dates[] = $format_date->id;
        }

        return [
            'name'          => ['bail', 'required', 'unique:languages,name,NULL,id,deleted_at,NULL'],
            'locale'        => ['bail', 'required', 'unique:languages,locale,NULL,id,deleted_at,NULL'],
            'timezone'      => ['required'],
            'currency'      => ['required'],
            'exchange_rate' => ['bail', 'required', 'integer'],
            'flag'          => ['required'],
            'format_date'   => ['required', Rule::in($format_dates)],
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
            'name'          => attr('language.name'),
            'locale'        => attr('language.locale'),
            'timezone'      => attr('language.timezone'),
            'currency'      => attr('language.currency'),
            'exchange_rate' => attr('language.exchange_rate'),
            'flag'          => attr('language.flag'),
            'format_date'   => attr('language.format_date')
        ];
    }
}
