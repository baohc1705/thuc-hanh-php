<?php
// Tự động nhận môi trường local hoặc hosting
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    // Đường dẫn LOCAL 
    $vnp_return = 'http://localhost/thuc-hanh-php/bookstore/vnpay_return.php';

} else {

    // Đường dẫn HOSTING
    $vnp_return = 'https://huynhchibao.42web.io/bookstore/vnpay_return.php';
}

return [
    'vnp_TmnCode'     => 'Q21B8B0O',
    'vnp_HashSecret'  => '5ECX8H6CE0I35756JVLOJXJ48LI8UJTY',
    'vnp_Url'         => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'vnp_ReturnUrl'   => $vnp_return,
    'vnp_Api'         => 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction'
];
