<?php

$is_local = ($_SERVER['HTTP_HOST'] === 'localhost');

return [
    'vnp_TmnCode'    => 'Q21B8B0O',
    'vnp_HashSecret' => '5ECX8H6CE0I35756JVLOJXJ48LI8UJTY',
    'vnp_Url'        => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'vnp_ReturnUrl'  => $is_local 
        ? 'http://localhost/thuc-hanh-php/vnpay_return.php'
        : 'https://huynhchibao.42web.io/vnpay_return.php',
];
?>
