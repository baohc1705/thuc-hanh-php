<?php
session_start();
require_once 'config/config.php';
$vnp_Config = require 'config/vnpay_config.php';

// LOG
file_put_contents(__DIR__ . "/vnpay_log.txt",
    date('Y-m-d H:i:s') . " | URL: " . $_SERVER['REQUEST_URI'] . "\n" .
    "GET: " . json_encode($_GET) . "\n" .
    "---\n",
    FILE_APPEND
);

// Lấy tham số trả về
$inputData = [];
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

$vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
unset($inputData['vnp_SecureHash']);
unset($inputData['vnp_SecureHashType']);

ksort($inputData);

// Tạo chuỗi hash theo chuẩn VNPAY
$hashData = '';
$i = 0;
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_Config['vnp_HashSecret']);

$orderId = $inputData['vnp_TxnRef'] ?? '';
$responseCode = $inputData['vnp_ResponseCode'] ?? '';
$transactionNo = $inputData['vnp_TransactionNo'] ?? '';

file_put_contents(__DIR__ . "/vnpay_log.txt",
    "OrderID: $orderId | ResponseCode: $responseCode | TransNo: $transactionNo\n" .
    "ExpectedHash: $secureHash\n" .
    "ReceivedHash: $vnp_SecureHash\n" .
    "Match: " . ($secureHash === $vnp_SecureHash ? 'YES' : 'NO') . "\n" .
    "---\n",
    FILE_APPEND
);

// Kiểm tra hash và response code
if ($secureHash === $vnp_SecureHash) {
    if ($responseCode == '00') {
        // Thanh toán thành công
        try {
            $pdo->beginTransaction();

            // Cập nhật trạng thái đơn hàng
            $stmt = $pdo->prepare("UPDATE orders 
                SET status = 'confirmed', payment_status = 'paid'
                WHERE id = ? LIMIT 1");
            $result = $stmt->execute([$orderId]);

            if ($result && $stmt->rowCount() > 0) {
                // Xóa giỏ hàng
                setcookie('unibook_cart', '', time() - 3600, '/');
                $pdo->commit();

                file_put_contents(__DIR__ . "/vnpay_log.txt",
                    "Order $orderId updated successfully\n---\n",
                    FILE_APPEND
                );

                header("Location: order-success.php?order_id=$orderId&payment=vnpay");
                exit;
            } else {
                throw new Exception("Order not found or already processed");
            }

        } catch (Exception $e) {
            $pdo->rollBack();
            file_put_contents(__DIR__ . "/vnpay_log.txt",
                "Error: " . $e->getMessage() . "\n---\n",
                FILE_APPEND
            );
            header("Location: order-fail.php?order_id=$orderId&error=update_failed");
            exit;
        }
    } else {
        //Người dùng hủy hoặc lỗi thanh toán
        file_put_contents(__DIR__ . "/vnpay_log.txt",
            "Payment failed. ResponseCode: $responseCode\n---\n",
            FILE_APPEND
        );
        header("Location: order-fail.php?order_id=$orderId&error=payment_failed");
        exit;
    }
} else {
    // Hash không khớp → gian lận
    file_put_contents(__DIR__ . "/vnpay_log.txt",
    "Hash mismatch!\n---\n",
    FILE_APPEND
    );
    header("Location: order-fail.php?order_id=&error=invalid_hash");
    exit;
}
?>
