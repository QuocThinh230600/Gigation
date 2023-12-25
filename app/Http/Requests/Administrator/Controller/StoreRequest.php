<?php

namespace App\Http\Requests\Administrator\Controller;

use App\Repositories\Controller\ControllerRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @var ControllerRepository
     * @author Quoc Tuan
     */
    protected $controller;

    /**
     * StoreRequest constructor.
     * @param ControllerRepository $controller
     * @author Quoc Tuan
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
     * @author Quoc Tuan
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @author Quoc Tuan
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     * @author Quoc Tuan
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     * @author Quoc Tuan
     */
    public function attributes(): array
    {
        return [];
    }
}
