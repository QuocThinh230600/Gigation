<?php

namespace App\Library\Administrator;


use Validator;
use Illuminate\Http\JsonResponse;
use App\Library\Administrator\Nganluong;


class BankCharge extends Nganluong
{
    protected $merchant_id = '';
    protected $merchant_password = '';
    protected $receiver_email = '';
    protected $url_api = 'https://www.nganluong.vn/checkout.api.nganluong.post.php';
    protected $cur_code = 'vnd';

    protected $return_url = '/';
    protected $cancel_url = '/';

    /**
     * Create new instance bank change.
     *
     * @return void
     */
    public function __construct()
    {
        $this->merchant_id       = config('nganluong.merchant_id');
        $this->merchant_password = config('nganluong.merchant_password');
        $this->receiver_email    = config('nganluong.receiver_email');
        $this->url_api           = config('nganluong.url_api', 'https://www.nganluong.vn/checkout.api.nganluong.post.php');
        $this->cur_code          = config('nganluong.cur_code', 'vnd');
        parent::__construct($this->merchant_id, $this->merchant_password, $this->receiver_email, $this->url_api);
    }

    /**
     * Checkout with method Bank ATM. <ATM_ONLINE>
     *
     * @param array $input
     * @return Response
     */
    public function ATM($input)
    {
        $validator = $this->validator($input);
        if (!$validator['success']) {
            return $validator;
        }
        $params     = $this->formatInput($input);
        $order_code = uniqid();

        return $this->BankCheckout(
            $order_code, $params['total_amount'],
            $params['bank_code'], $params['payment_type'],
            $params['order_description'],
            $params['tax_amount'], $params['fee_shipping'], $params['discount_amount'],
            $params['return_url'], $params['cancel_url'],
            $params['fullname'], $params['email'], $params['mobile'], $params['address'],
            $params['items']
        );
    }

    /**
     * Checkout with method Visa, Mastercard <VISA>
     *
     * @param array $input
     * @return Response
     */
    public function VISA($input)
    {
        $validator = $this->validator($input);
        if (!$validator['success']) {
            return $validator;
        }
        $params     = $this->formatInput($input);
        $order_code = uniqid();

        return $this->VisaCheckout(
            $order_code, $params['total_amount'],
            $params['payment_type'],
            $params['order_description'],
            $params['tax_amount'], $params['fee_shipping'], $params['discount_amount'],
            $params['return_url'], $params['cancel_url'],
            $params['fullname'], $params['email'], $params['mobile'], $params['address'],
            $params['items'], $params['bank_code']
        );
    }

    /**
     * Dùng để kiểm tra trạng thái thanh toán, truy vấn thông tin giao dịch của một đơn hàng.
     *
     * @param string $ngl_token token cuả ngân lượng
     * @return Response
     */
    public function TransactionDetail($ngl_token)
    {
        $ngl_result  = $this->GetTransactionDetail($ngl_token);
        $ngl_message = $this->GetErrorMessage($ngl_result->error_code);

        if (
            '00' == $ngl_result->error_code &&
            '00' == $ngl_result->transaction_status
        ) {
            return [
                'message' => $ngl_message,
                'code'    => 200,
                'status'  => true,
                'data'    => $ngl_result
            ];
        }

        return [
            'message' => $ngl_message,
            'code'    => 203,
            'status'  => false
        ];
    }

    /**
     * Validator input.
     *
     * @param array $input
     * @return JsonResponse
     */
    protected function validator($input)
    {
        $rule = [
            'bank_code'    => 'required',
            'total_amount' => 'required',
            'fullname'     => 'required',
            'email'        => 'required|email',
            'mobile'       => 'required',
            'address'      => 'required',
        ];
        $messages = [
            'bank_code.required'    => 'Tài khoản ngân hàng không được để trống',
            'total_amount.required' => 'Tổng tiền không được để trống',
            'fullname.required'     => 'Họ và tên không được để trống',
            'email.required'        => 'Tài khoản ngân hàng không được để trống',
            'email.email'           => 'Địa chỉ email không chính xác',
            'mobile.required'       => 'Số điện thoại không được bỏ trống',
            'address.required'      => 'Địa chỉ không được để trống'
        ];
        $validator = Validator::make($input,$rule,$messages);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'validateFailure',
                'errors'  => $validator->errors()->getMessages()
            ];
        }

        return [
            'success' => true,
            'message' => 'validatePass'
        ];
    }

    /**
     * Format input for checkout with NganLuong
     *
     * @param array $input
     * @return array
     */
    protected function formatInput($input)
    {
        return [
            // buyer
            'fullname'          => $input['fullname'],
            'email'             => $input['email'],
            'mobile'            => $input['mobile'],
            'address'           => $input['address'],
            // URL for Redirect
            'return_url'        => isset($input['return_url']) ? $input['return_url'] : $this->return_url,
            'cancel_url'        => isset($input['cancel_url']) ? $input['cancel_url'] : $this->cancel_url,
            // Fees
            'total_amount'      => isset($input['total_amount']) ? $input['total_amount'] : 0,
            'tax_amount'        => config('nganluong.tax_amount', 0),
            'fee_shipping'      => config('nganluong.fee_shipping', 0),
            'discount_amount'   => config('nganluong.discount_amount', 0),
            'bank_code'         => isset($input['bank_code']) ? $input['bank_code'] : '',
            'payment_type'      => isset($input['payment_type']) ? $input['payment_type'] : '',
            'order_description' => isset($input['order_description']) ? $input['order_description'] : '',
            // Items
            'items'             => [
                0 => [
                    'item_name1'     => isset($input['product_name']) ? $input['product_name'] : 'NGL Checkout',
                    'item_quantity1' => 1,
                    'item_amount1'   => $input['total_amount'],
                    'item_url1'      => isset($input['product_url']) ? $input['product_url'] : '',
                ]
            ]
        ];
    }

}