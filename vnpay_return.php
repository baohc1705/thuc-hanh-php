<?php
session_start();
require_once 'config/config.php';
$vnp_Config = require 'config/vnpay_config.php';


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


// Kiểm tra hash và response code
if ($secureHash === $vnp_SecureHash) {
    if ($responseCode == '00') {
        // Thanh toán thành công
        try {
            $pdo->beginTransaction();

            // Nếu đơn chưa tồn tại (do chỉ tạo sau khi thanh toán thành công), tạo từ session pending
            $stmtCheck = $pdo->prepare("SELECT id FROM orders WHERE id = ? LIMIT 1");
            $stmtCheck->execute([$orderId]);
            $orderExists = $stmtCheck->fetchColumn();

            if (!$orderExists) {
                $pending = $_SESSION['pending_vnpay_order'] ?? null;
                if (!$pending || ($pending['order_id'] ?? '') !== $orderId) {
                    throw new Exception("Không tìm thấy dữ liệu đơn hàng tạm để lưu sau khi thanh toán");
                }

                // Tạo đơn hàng mới
                $sqlInsert = "INSERT INTO orders 
                    (id, user_id, total_price, recipient, phone, address, note, 
                     status, payment_status, payment_method, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->execute([
                    $pending['order_id'],
                    $pending['user_id'],
                    $pending['total_price'],
                    $pending['recipient'],
                    $pending['phone'],
                    $pending['address'],
                    $pending['note'],
                    'pending',
                    'unpaid',
                    'vnpay',
                    $pending['created_at'],
                ]);

                // Lưu chi tiết đơn hàng
                $sqlDetail = "INSERT INTO order_detail (order_id, product_id, quantity, price, total) 
                              VALUES (?, ?, ?, ?, ?)";
                $stmtDetail = $pdo->prepare($sqlDetail);
                foreach ($pending['cart_items'] as $item) {
                    $stmtDetail->execute([
                        $pending['order_id'],
                        $item['id'],
                        $item['quantity'],
                        $item['price'],
                        $item['price'] * $item['quantity']
                    ]);
                }
            }

            // Cập nhật trạng thái đơn hàng
            $stmt = $pdo->prepare("UPDATE orders 
                SET status = 'confirmed', payment_status = 'paid'
                WHERE id = ? LIMIT 1");
            $result = $stmt->execute([$orderId]);

            if ($result && $stmt->rowCount() > 0) {
                // Xóa giỏ hàng
                setcookie('unibook_cart', '', time() - 3600, '/');
                // Xóa đơn tạm
                unset($_SESSION['pending_vnpay_order']);
                $pdo->commit();

                header("Location: order-success.php?order_id=$orderId&payment=vnpay");
                exit;
            } else {
                throw new Exception("Order not found or already processed");
            }

        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: order-fail.php?order_id=$orderId&error=update_failed");
            exit;
        }
    } else {
        header("Location: order-fail.php?order_id=$orderId&error=payment_failed&vnp_code=$responseCode");
        exit;
    }
} else {
    header("Location: order-fail.php?order_id=&error=invalid_hash");
    exit;
}
?>
