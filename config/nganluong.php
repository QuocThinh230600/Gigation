<?php
return [
    /*
     * Link api duyệt thanh toán
     *
     *
     * */
    'url_api' => env('NGAN_LUONG_URL_API', 'https://www.nganluong.vn/checkout.api.nganluong.post.php'),

    /*
     * Mã kết nối
     *
     *
     * */
    'merchant_id' => env('NGAN_LUONG_MERCHANT_ID', '36680'),

    /*
     * Mật khẩu kết nối
     *
     *
     * */
    'merchant_password' => env('NGAN_LUONG_MERCHANT_PASSWORD', ''),

    /*
     * Email tài khoản Ngân Lượng
     *
     *
     * */
    'receiver_email' => env('NGAN_LUONG_RECEIVER_EMAIL', 'demo@nganluong.vn')
];