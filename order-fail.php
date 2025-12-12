<?php
session_start();
include('config/config.php');

$orderId    = isset($_GET['order_id']) && is_numeric($_GET['order_id']) ? (int)$_GET['order_id'] : null;
$errorKey   = $_GET['error'] ?? 'payment_failed';
$vnpCode    = $_GET['vnp_code'] ?? ($_GET['vnp_ResponseCode'] ?? '');

$errorMessages = [
    'payment_failed' => 'Thanh toán chưa hoàn tất hoặc đã bị hủy. Vui lòng thử lại.',
    'update_failed'  => 'Hệ thống chưa ghi nhận được trạng thái đơn hàng. Bạn vui lòng thử lại hoặc liên hệ hỗ trợ.',
    'invalid_hash'   => 'Dữ liệu thanh toán không hợp lệ nên giao dịch đã bị từ chối.',
    'unknown'        => 'Giao dịch không thành công. Bạn vui lòng thử lại sau ít phút.'
];

$vnpMessages = [
    '07' => 'Giao dịch bị nghi ngờ gian lận. Ngân hàng/ VNPAY đã tạm giữ tiền và sẽ hoàn theo quy định.',
    '09' => 'Giao dịch đang được xử lý. Vui lòng chờ hoặc thử lại sau ít phút.',
    '11' => 'Thẻ hoặc tài khoản đã hết hạn/ không tồn tại. Vui lòng kiểm tra lại thông tin.',
    '12' => 'Thẻ/ tài khoản đang bị khóa hoặc hạn chế giao dịch. Liên hệ ngân hàng để mở khóa.',
    '13' => 'Sai mật khẩu/ OTP xác thực. Vui lòng thử lại và kiểm tra tin nhắn OTP.',
    '24' => 'Bạn đã hủy giao dịch trước khi thanh toán hoàn tất.',
    '51' => 'Tài khoản không đủ số dư để thực hiện thanh toán.',
    '65' => 'Vượt quá hạn mức giao dịch hoặc số lần thanh toán trong ngày.',
    '75' => 'Ngân hàng phát hành đang bảo trì hoặc tạm dừng dịch vụ. Vui lòng thử lại sau.',
    '79' => 'Nhập sai OTP vượt quá số lần cho phép. Thử lại sau ít phút hoặc liên hệ ngân hàng.',
    '91' => 'Ngân hàng phát hành không phản hồi. Vui lòng thử lại sau.',
    '93' => 'Tài khoản/ thẻ bị khóa hoặc không tồn tại.',
    '99' => 'Lỗi không xác định từ VNPAY. Vui lòng thử lại hoặc chọn phương thức khác.'
];

$primaryMessage = $errorMessages[$errorKey] ?? $errorMessages['unknown'];
$detailMessage  = $vnpCode
    ? ($vnpMessages[$vnpCode] ?? 'VNPAY trả về mã lỗi ' . htmlspecialchars($vnpCode) . '. Bạn vui lòng thử lại hoặc chọn phương thức khác.')
    : 'Chúng tôi chưa nhận được mã lỗi cụ thể từ VNPAY. Bạn có thể thử thanh toán lại hoặc chọn phương thức khác.';

// Lấy thông tin đơn hàng (nếu có)
$order = null;
$orderErr = '';
if ($orderId) {
    try {
        if (isset($_SESSION['user_id'])) {
            $stmt = $pdo->prepare("SELECT id, recipient, phone, address, total_price, payment_method, payment_status, created_at 
                                   FROM orders WHERE id = ? AND user_id = ? LIMIT 1");
            $stmt->execute([$orderId, $_SESSION['user_id']]);
        } else {
            $stmt = $pdo->prepare("SELECT id, recipient, phone, address, total_price, payment_method, payment_status, created_at 
                                   FROM orders WHERE id = ? LIMIT 1");
            $stmt->execute([$orderId]);
        }
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $orderErr = $e->getMessage();
    }
}

function renderPaymentName(?string $method): string
{
    return match ($method) {
        'cod'   => 'COD',
        'vnpay' => 'VNPAY',
        default => 'Không xác định',
    };
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán thất bại - UniBook</title>
    <?php include('include/lib.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center py-4">
                    <div class="display-4 text-danger mb-3">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <h2 class="fw-bold text-danger mb-2">Thanh toán thất bại</h2>
                    <p class="text-muted fs-5 mb-2"><?= $primaryMessage ?></p>
                    <?php if ($vnpCode): ?>
                        <span class="badge bg-dark px-3 py-2">Mã VNPAY: <?= htmlspecialchars($vnpCode) ?></span>
                    <?php endif; ?>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Chi tiết lỗi</h5>
                        <p class="mb-3"><?= $detailMessage ?></p>
                        <ul class="text-muted small ps-3 mb-0">
                            <li>Kiểm tra số dư/ hạn mức thẻ hoặc tài khoản.</li>
                            <li>Thử thanh toán lại sau ít phút hoặc chọn phương thức COD.</li>
                            <li>Liên hệ ngân hàng nếu liên tục gặp lỗi hoặc thẻ bị khóa.</li>
                        </ul>
                    </div>
                </div>

                <?php if ($order): ?>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Thông tin đơn hàng</h5>
                                <span class="badge bg-outline-danger text-danger border border-danger">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <td class="text-muted">Người nhận</td>
                                            <td class="fw-medium"><?= htmlspecialchars($order['recipient']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Số điện thoại</td>
                                            <td><?= htmlspecialchars($order['phone']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Địa chỉ</td>
                                            <td><?= htmlspecialchars($order['address']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <td class="text-muted">Thời gian đặt</td>
                                            <td><?= date('H:i - d/m/Y', strtotime($order['created_at'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Phương thức</td>
                                            <td><span class="badge bg-secondary"><?= renderPaymentName($order['payment_method']) ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Trạng thái</td>
                                            <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($order['payment_status']) ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="border-top pt-3 mt-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5">Tổng thanh toán</span>
                                <span class="text-danger fw-bold fs-4"><?= number_format($order['total_price'], 0, ',', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                <?php elseif ($orderErr): ?>
                    <div class="alert alert-warning">Không thể tải thông tin đơn hàng: <?= htmlspecialchars($orderErr) ?></div>
                <?php endif; ?>

               

                <div class="text-center">
                    <a href="checkout.php" class="btn btn-danger btn-lg px-4 me-2">Thử thanh toán lại</a>
                    <a href="cart.php" class="btn btn-outline-secondary btn-lg px-4 me-2">Quay lại giỏ hàng</a>
                    <a href="index.php" class="btn btn-link">Tiếp tục mua sắm</a>
                </div>

            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
