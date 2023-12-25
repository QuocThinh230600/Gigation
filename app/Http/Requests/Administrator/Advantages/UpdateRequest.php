<?php

namespace App\Http\Requests\Administrator\Advantages;

use App\Repositories\Advantages\AdvantagesRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $attribute;

    /**
     * UpdateRequest constructor.
     * @param AdvantagesRepository $attribute
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(AdvantagesRepository $advantages)
    {
        parent::__construct();
        $this->advantages = $advantages;
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

        return [
            'name' => ['required']
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
    public function advantages()
    {
        return [
            'name' => attr('advantages.name')
        ];
    }
}
