<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$order = null;
$items = [];
$err = '';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    $err = 'Mã đơn không hợp lệ.';
} else {
    try {
        // Lấy thông tin đơn
        $sql = "SELECT o.*, u.fullname, u.email
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.id = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            $err = 'Không tìm thấy đơn hàng.';
        } else {
            // Kiểm tra quyền truy cập: chủ đơn hoặc admin
            $isOwner = $_SESSION['user_id'] == $order['user_id'];
            $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 1;
            if (!($isOwner || $isAdmin)) {
                $err = 'Bạn không có quyền xem đơn hàng này.';
                $order = null;
            } else {
                // Lấy chi tiết đơn hàng
                $sql2 = "SELECT od.*, p.title AS product_title, p.image AS product_image
                         FROM order_detail od
                         LEFT JOIN product p ON od.product_id = p.id
                         WHERE od.order_id = ?";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute([$id]);
                $items = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    } catch (PDOException $e) {
        $err = 'Lỗi hệ thống: ' . $e->getMessage();
    }
}

// map trạng thái và phương thức
$status_map = [
    'pending' => 'Chờ xử lý',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Đã giao',
    'cancelled' => 'Đã hủy'
];
$payment_map = [
    'cod' => 'Thanh toán khi nhận hàng (COD)',
    'vnpay' => 'Chuyển khoản ngân hàng'
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Chi tiết đơn hàng #<?= $id ?></title>
    <?php include('include/lib.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="order-list.php">Đơn hàng của tôi</a></li>
                    <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="container my-5">
        <?php if ($err): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
            <a href="order-list.php" class="btn btn-secondary">Quay lại</a>
        <?php else: ?>
            <div class="mb-4 d-flex justify-content-between align-items-start">
                <div>
                    <h3>Chi tiết đơn hàng <small class="text-muted">#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></small></h3>
                    <div class="text-muted">Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></div>
                </div>
                <div class="text-end">
                    <a href="order-list.php" class="btn btn-outline-secondary">Đơn hàng của tôi</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Thông tin giao hàng</h5>
                            <p class="mb-1"><strong>Người nhận:</strong> <?= htmlspecialchars($order['recipient'] ?? $order['fullname']) ?></p>
                            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                            <p class="mb-1"><strong>Địa chỉ:</strong> <?= nl2br(htmlspecialchars($order['address'])) ?></p>
                            <p class="mb-1"><strong>Ghi chú:</strong> <?= nl2br(htmlspecialchars($order['note'])) ?></p>
                            <p class="mb-1"><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($payment_map[$order['payment_method']] ?? $order['payment_method']) ?></p>
                            <p class="mb-1"><strong>Trạng thái:</strong>
                                <span class="badge <?= ($order['status'] == 'pending') ? 'bg-warning text-dark' : (($order['status'] == 'delivered') ? 'bg-success' : 'bg-secondary') ?>">
                                    <?= htmlspecialchars($status_map[$order['status']] ?? $order['status']) ?>
                                </span>
                            </p>
                            <p class="mb-1"><strong>Trạng thái thanh toán:</strong>
                                <span class="badge <?= ($order['payment_status'] === 'unpaid') ? 'bg-warning text-dark' : 'bg-success' ?>">
                                    <?= ($order['payment_status'] == 'unpaid') ? 'Chưa thanh toán' : 'Đã thanh toán' ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Sản phẩm</h5>
                            <?php if (empty($items)): ?>
                                <div class="alert alert-info">Không có sản phẩm trong đơn hàng.</div>
                            <?php else: ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($items as $it): ?>
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="products/<?= htmlspecialchars($it['product_image'] ?? '') ?>" alt="<?= htmlspecialchars($it['product_title'] ?? '') ?>" style="width:70px; height:70px; object-fit:contain;">
                                                </div>
                                                <div class="col">
                                                    <div class="fw-semibold"><?= htmlspecialchars($it['product_title'] ?? 'Sản phẩm') ?></div>
                                                    <div class="text-muted small"><?= number_format($it['price'], 0, ',', '.') ?> đ x <?= (int)$it['quantity'] ?> = <span class="fw-bold text-danger"><?= number_format($it['total'], 0, ',', '.') ?> đ</span></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>Tổng cộng</div>
                                        <div class="fw-bold text-danger"><?= number_format($order['total_price'], 0, ',', '.') ?> đ</div>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <aside class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="mb-3">Tóm tắt</h6>
                            <p class="mb-2"><small class="text-muted">Mã đơn</small><br>#<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></p>
                            <p class="mb-2"><small class="text-muted">Ngày đặt</small><br><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                            <p class="mb-2"><small class="text-muted">Trạng thái</small><br><?= htmlspecialchars($status_map[$order['status']] ?? $order['status']) ?></p>
                            <p class="mb-2"><small class="text-muted">Phương thức</small><br><?= htmlspecialchars($payment_map[$order['payment_method']] ?? $order['payment_method']) ?></p>
                            <hr>
                            <p class="mb-0"><strong class="fs-5 text-danger"><?= number_format($order['total_price'], 0, ',', '.') ?> đ</strong></p>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-3">Hành động (Admin)</h6>
                                <a href="admin/edit-order.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-primary w-100 mb-2">Cập nhật trạng thái</a>
                                <a href="admin/orders.php" class="btn btn-sm btn-outline-secondary w-100">Quay lại quản lý</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        <?php endif; ?>
    </main>

    <?php include('footer.php'); ?>
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>