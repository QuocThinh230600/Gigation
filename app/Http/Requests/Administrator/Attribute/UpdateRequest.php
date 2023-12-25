<?php

namespace App\Http\Requests\Administrator\Attribute;

use App\Repositories\Attribute\AttributeRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $attribute;

    /**
     * UpdateRequest constructor.
     * @param AttributeRepository $attribute
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(AttributeRepository $attribute)
    {
        parent::__construct();
        $this->attribute = $attribute;
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
        $id = $this->attribute->getIdByUuid($this->route('attribute'));

        return [
            'name' => ['bail', 'required', 'unique:attributes_translations,name,' . $id . ',attribute_id,deleted_at,NULL']
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
            'name' => attr('attribute.name')
        ];
    }
}
