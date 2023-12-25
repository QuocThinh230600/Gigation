<?php

namespace App\Http\Requests\Administrator\Producer;

use App\Repositories\Producer\ProducerRepository;
use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
{
    protected $producer;

    /**
     * TranslationRequest constructor.
     * @param ProducerRepository $producer
     */
    public function __construct(ProducerRepository $producer)
    {
        parent::__construct();
        $this->producer = $producer;
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
        $id = $this->producer->getIdByUuid($this->route('producer'));

        return [
            'name'  => ['bail', 'required', 'unique:producers_translations,name,' . $id . ',id,deleted_at,NULL'],
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
            'name'  => attr('producer.name'),
        ];
    }
}
