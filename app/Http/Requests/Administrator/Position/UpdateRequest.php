<?php

namespace App\Http\Requests\Administrator\Position;

use App\Repositories\Position\PositionRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    protected $position;

    /**
     * UpdateRequest constructor.
     * @param PositionRepository $position
     * @author Quốc Tuấn
     */
    public function __construct(PositionRepository $position)
    {
        parent::__construct();
        $this->position = $position;
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
        $id = $this->position->getIdByUuid($this->route('position'));

        return [
            'name'      => ['required', 'unique:positions,name,' . $id . ',id,deleted_at,NULL'],
            'parent_id' => ['required', 'exists:positions,id'],
            'position'  => ['bail', 'required', 'integer', 'gte:0'],
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
            'name'      => attr('position.name'),
            'parent_id' => attr('position.parent'),
            'position'  => attr('position.position'),
        ];
    }
}
