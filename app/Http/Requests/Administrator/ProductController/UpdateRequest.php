<?php

namespace App\Http\Requests\Administrator\ProductController;

use App\Repositories\ProductController\ProductControllerRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @var ProductControllerRepository
     */
    protected $productController;

    /**
     * UpdateRequest constructor.
     * @param ProductControllerRepository $productController
     */
    public function __construct(ProductControllerRepository $productController)
    {
        parent::__construct();
        $this->productController = $productController;
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
        $id = $this->productController->getIdByUuid($this->route('product_controller'));

        return [
            //'...' => 'required|unique:product_controller,...,'.$id.',id,deleted_at,NULL'
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
