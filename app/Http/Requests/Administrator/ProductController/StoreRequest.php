<?php

namespace App\Http\Requests\Administrator\ProductController;

use App\Repositories\ProductController\ProductControllerRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @var ProductControllerRepository
     * @author Quoc Tuan
     */
    protected $productController;

    /**
     * StoreRequest constructor.
     * @param ProductControllerRepository $productController
     * @author Quoc Tuan
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
