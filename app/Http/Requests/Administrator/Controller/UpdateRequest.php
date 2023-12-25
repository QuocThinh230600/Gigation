<?php

namespace App\Http\Requests\Administrator\Controller;

use App\Repositories\Controller\ControllerRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @var ControllerRepository
     */
    protected $controller;

    /**
     * UpdateRequest constructor.
     * @param ControllerRepository $controller
     */
    public function __construct(ControllerRepository $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->controller->getIdByUuid($this->route('controller'));

        return [
            //'...' => 'required|unique:controller,...,'.$id.',id,deleted_at,NULL'
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }
}
