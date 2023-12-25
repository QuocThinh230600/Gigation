<?php

namespace App\Http\Requests\Administrator\coupon;

use App\Repositories\coupon\couponRepository;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @var couponRepository
     * @author Quoc Tuan
     */
    protected $coupon;

    /**
     * StoreRequest constructor.
     * @param couponRepository $coupon
     * @author Quoc Tuan
     */
    public function __construct(couponRepository $coupon)
    {
        parent::__construct();
        $this->coupon = $coupon;
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
