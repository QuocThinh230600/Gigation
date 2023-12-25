<?php

namespace App\Http\Requests\Administrator\coupon;

use App\Repositories\coupon\couponRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @var couponRepository
     */
    protected $coupon;

    /**
     * UpdateRequest constructor.
     * @param couponRepository $coupon
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
        $id = $this->coupon->getIdByUuid($this->route('coupon'));

        return [
            //'...' => 'required|unique:coupon,...,'.$id.',id,deleted_at,NULL'
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
