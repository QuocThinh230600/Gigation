<?php

namespace App\Http\Requests\Administrator\Language;

use App\Repositories\Language\LanguageRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $language;

    /**
     * UpdateRequest constructor.
     * @param LanguageRepository $language
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LanguageRepository $language)
    {
        parent::__construct();
        $this->language = $language;
    }

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

        $id = $this->language->getIdByUuid($this->route('language'));

        return [
            'name'          => ['bail', 'required', 'unique:languages,name,' . $id . ',id,deleted_at,NULL'],
            'locale'        => ['bail', 'required', 'unique:languages,locale,' . $id . ',id,deleted_at,NULL'],
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
