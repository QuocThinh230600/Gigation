<?php

namespace App\Http\Requests\Administrator\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * UpdateRequest constructor.
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->product = $product;
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
        $id = $this->product->getIdByUuid($this->route('product'));

        return [
            //'...' => 'required|unique:product,...,'.$id.',id,deleted_at,NULL'
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
