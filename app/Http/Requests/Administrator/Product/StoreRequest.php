<?php

namespace App\Http\Requests\Administrator\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @var ProductRepository
     * @author Quoc Tuan
     */
    protected $product;

    /**
     * StoreRequest constructor.
     * @param ProductRepository $product
     * @author Quoc Tuan
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
