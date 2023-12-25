<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Administrator\Nganluong;


class TestPayment extends Controller
{
    public $nlcheckout;

    public function __construct()
    {
        $this->nlcheckout = new Nganluong(env('NGAN_LUONG_MERCHANT_ID'), env('NGAN_LUONG_MERCHANT_PASSWORD'), env('NGAN_LUONG_RECEIVER_EMAIL'),env('NGAN_LUONG_URL_API') ,env('NGAN_LUONG_CODE'));
    }

    public function createOrder(Request $request)
    {
        $total_amount = $request->total_amount;

        $array_items[0] = array('item_name1'     => 'Product name',
                                'item_quantity1' => 1,
                                'item_amount1'   => $total_amount,
                                'item_url1'      => 'http://nganluong.vn/');

        $payment_method = $request->option_payment;
        $bank_code      = @$request->bankcode;
        $order_code     = "macode_" . time();

        $payment_type      = '';
        $discount_amount   = 0;
        $order_description = '';
        $tax_amount        = 0;
        $fee_shipping      = 0;
        $return_url        = route('pay_success');
        $cancel_url        = route('orderId', ['orderid' => $order_code]);

        $buyer_fullname = $request->buyer_fullname;
        $buyer_email    = $request->buyer_email;
        $buyer_mobile   = $request->buyer_mobile;

        $buyer_address = '';
        if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
            if ($payment_method == "VISA") {

                $nl_result = $this->nlcheckout->__VisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                    $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                    $buyer_address, $array_items, $bank_code);

            } elseif ($payment_method == "NL") {
                $nl_result = $this->nlcheckout->__NLCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                    $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                    $buyer_address, $array_items);

            } elseif ($payment_method == "ATM_ONLINE" && $bank_code != '') {
                $nl_result = $this->nlcheckout->__BankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount,
                    $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                    $buyer_address, $array_items);
            } elseif ($payment_method == "NH_OFFLINE") {
                $nl_result = $this->nlcheckout->__officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
            } elseif ($payment_method == "ATM_OFFLINE") {
                $nl_result = $this->nlcheckout->__BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);

            } elseif ($payment_method == "IB_ONLINE") {
                $nl_result = $this->nlcheckout->__IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
            } elseif ($payment_method == "CREDIT_CARD_PREPAID") {

                $nl_result = $this->nlcheckout->__PrepaidVisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
            }

            if ($nl_result->error_code == '00') {
                return redirect()->to($nl_result->checkout_url);
            } else {
                return redirect()->back()->withErrors(['error' => $nl_result->error_message]);
            }

        } else {
            return redirect()->back()->withErrors(['error' => 'Vui lòng nhập đầy đủ thông tin']);
        }
    }

    public function getStatusCode()
    {
        $nl_result = $this->nlcheckout->__GetTransactionDetail(request()->get('token'));
        if($nl_result){
            $nl_errorcode           = (string)$nl_result->error_code;
            $nl_transaction_status  = (string)$nl_result->transaction_status;
            if($nl_errorcode == '00') {
                if($nl_transaction_status == '00') {
                   $result = $nl_result;
                }
            }else{
                $result = $nlcheckout->GetErrorMessage($nl_errorcode);
            }
        }

        return view('pay_success')->with('status_code' , $result);
    }
}