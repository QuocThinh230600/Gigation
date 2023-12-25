<?php

namespace App\Http\Requests\Administrator\Image;

use App\Repositories\Image\ImageRepository;
use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
{
    protected $image;

    /**
     * UpdateRequest constructor.
     * @param ImageRepository $image
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ImageRepository $image)
    {
        parent::__construct();
        $this->image = $image;
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
        $id = $this->image->getIdByUuid($this->route('image'));

        return [
            'name' => ['bail', 'required', 'unique:images_translations,name,' . $id . ',image_id,deleted_at,NULL'],
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
            'name' => attr('images_position.name'),
        ];
    }
}
