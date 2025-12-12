<?php
session_start();
include('config/config.php');

// Kiểm tra có order_id không
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    header('Location: cart.php');
    exit;
}

$order_id = (int)$_GET['order_id'];

// Lấy thông tin đơn hàng
try {
    $sql = "SELECT o.*, 
                   CASE 
                       WHEN o.payment_method = 'cod' THEN 'COD'
                       WHEN o.payment_method = 'vnpay' THEN 'VNPAY'
                       ELSE 'Không xác định'
                   END as payment_name
            FROM orders o 
            WHERE o.id = ? AND o.user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id, $_SESSION['user_id'] ?? 0]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        die('<div class="alert alert-danger text-center">Không tìm thấy đơn hàng!</div>');
    }

    // Lấy chi tiết đơn hàng
    $sqlDetail = "SELECT od.*, p.title, p.image 
                  FROM order_detail od 
                  JOIN product p ON od.product_id = p.id 
                  WHERE od.order_id = ?";
    $stmtDetail = $pdo->prepare($sqlDetail);
    $stmtDetail->execute([$order_id]);
    $items = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    die("Lỗi tải đơn hàng: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt hàng thành công - UniBook</title>
    <?php include('include/lib.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Thành công -->
                <div class="text-center py-5">
                    <h2 class="fw-bold text-success mb-3">Đặt hàng thành công!</h2>
                    <p class="text-muted fs-5">
                        Cảm ơn bạn đã mua sắm tại <strong>UniBook</strong>.<br>
                        Đơn hàng của bạn đã được tiếp nhận và đang chờ xử lý.
                    </p>
                </div>

                <!-- Thông tin đơn hàng -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5 class="fw-bold text-danger mb-3">Thông tin đơn hàng</h5>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="text-muted">Mã đơn hàng</td>
                                        <td class="fw-bold">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Thời gian đặt</td>
                                        <td><?= date('H:i - d/m/Y', strtotime($order['created_at'])) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Người nhận</td>
                                        <td class="fw-medium"><?= htmlspecialchars($order['recipient']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Số điện thoại</td>
                                        <td><?= htmlspecialchars($order['phone']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Địa chỉ giao</td>
                                        <td><?= htmlspecialchars($order['address']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Phương thức thanh toán</td>
                                        <td>
                                            <span class="badge bg-success fs-6"><?= $order['payment_name'] ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Trạng thái thanh toán</td>
                                        <td>
                                            <span class="badge <?= $order['payment_status'] === 'paid' ? 'bg-success' : 'bg-warning' ?> fs-6"><?= $order['payment_status'] ?></span>
                                        </td>
                                    </tr>
                                    <?php if (!empty($order['note'])): ?>
                                    <tr>
                                        <td class="text-muted">Ghi chú</td>
                                        <td><em><?= htmlspecialchars($order['note']) ?></em></td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold text-danger mb-3">Sản phẩm đã đặt (<?= count($items) ?> món)</h5>
                                <div style="max-height: 300px; overflow-y: auto;">
                                    <?php foreach ($items as $item): ?>
                                    <div class="d-flex mb-3 pb-3 border-bottom">
                                        <img src="products/<?= htmlspecialchars($item['image']) ?>" 
                                             class="rounded me-3 object-fit-contain" width="50">
                                        <div class="flex-grow-1">
                                            <div class="small fw-medium"><?= htmlspecialchars($item['title']) ?></div>
                                            <small class="text-muted">x<?= $item['quantity'] ?></small>
                                        </div>
                                        <div class="text-danger fw-bold">
                                            <?= number_format($item['total'], 0, ',', '.') ?>đ
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="border-top pt-3 mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fs-5 fw-bold">Tổng thanh toán</span>
                                        <span class="text-danger fs-3 fw-bold">
                                            <?= number_format($order['total_price'], 0, ',', '.') ?>đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nút hành động -->
                <div class="text-center mt-5">
                    <a href="order-detail.php?id=<?= $order_id ?>" class="btn btn-outline-primary btn-lg px-5 me-3">
                        Xem chi tiết đơn hàng
                    </a>
                    <a href="index.php" class="btn btn-danger btn-lg px-5">
                        Tiếp tục mua sắm
                    </a>
                </div>

                <!-- Gợi ý -->
                <div class="alert alert-info mt-5 text-center">
                    <i class="bi bi-info-circle"></i>
                    Chúng tôi đã gửi thông báo đơn hàng qua email và sẽ liên hệ bạn sớm nhất!<br>
                    Nếu chọn <strong>COD</strong>, vui lòng chuẩn bị đúng số tiền khi nhận hàng nhé!
                </div>

            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>