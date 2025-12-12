<?php
include('../config/_admin-auth.php');
include('../config/config.php');

$order = null;
$err = '';
$msg = '';

$order_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if ($order_id <= 0) {
    $err = 'Mã đơn hàng không hợp lệ.';
} else {
    try {
        // Lấy thông tin đơn hàng
        $sql = "SELECT o.*, u.fullname, u.email 
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.id = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$order_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            $err = 'Không tìm thấy đơn hàng.';
        }
    } catch (PDOException $e) {
        $err = 'Lỗi hệ thống: ' . $e->getMessage();
    }
}

// Xử lý cập nhật trạng thái
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $order) {
    $new_status = $_POST['status'] ?? '';

    if (empty($new_status)) {
        $err = 'Vui lòng chọn trạng thái.';
    } elseif (!in_array($new_status, ['pending', 'confirmed', 'shipping', 'delivered', 'cancelled'])) {
        $err = 'Trạng thái không hợp lệ.';
    } else {
        try {
            $sql = "UPDATE orders SET status = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$new_status, $order_id]);

            $order['status'] = $new_status;
            $msg = 'Cập nhật trạng thái đơn hàng thành công.';
        } catch (PDOException $e) {
            $err = 'Lỗi cập nhật: ' . $e->getMessage();
        }
    }
}

$status_map = [
    'pending' => 'Chờ xử lý',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Đã giao',
    'received' => 'Đã nhận hàng',
    'cancelled' => 'Đã hủy'
];

$payment_map = [
    'cod' => 'Thanh toán khi nhận hàng (COD)',
    'bank_transfer' => 'Chuyển khoản ngân hàng'
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Cập nhật đơn hàng #<?= $order_id ?></title>
    <?php include('include/lib.php') ?>
    <style>
        .order-header {
            background: linear-gradient(135deg, #0aad0a 0%, #08a308 50%, #067006 100%);
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #cfe2ff;
            color: #084298;
        }

        .status-shipping {
            background: #cff4fc;
            color: #055160;
        }

        .status-delivered {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-received {
            background: #f8d7da;
            color: #084298;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }
    </style>
</head>

<body>
    <?php include('header.php') ?>

    <div class="main-wrapper">
        <?php include('sidebar.php') ?>

        <main class="main-content-wrapper">
            <div class="container">
                <!-- breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="orders.php">Đơn hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cập nhật đơn #<?= $order_id ?></li>
                    </ol>
                </nav>

                <?php if ($err): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
                    <a href="orders.php" class="btn btn-secondary">Quay lại</a>
                <?php else: ?>
                    <?php if ($msg): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
                    <?php endif; ?>

                    <!-- Order Header -->
                    <div class="order-header d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="mb-2">Đơn hàng #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?></h3>
                            <div class="small">
                                Khách: <strong><?= htmlspecialchars($order['fullname']) ?></strong> ·
                                Email: <strong><?= htmlspecialchars($order['email']) ?></strong>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="mb-2">Ngày đặt: <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></div>
                            <div class="status-badge status-<?= $order['status'] ?>">
                                <?= htmlspecialchars($status_map[$order['status']] ?? $order['status']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            <!-- Cập nhật trạng thái -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Cập nhật trạng thái đơn hàng</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select form-select-lg" required>
                                                <option value="">-- Chọn trạng thái --</option>
                                                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>
                                                    Chờ xử lý
                                                </option>
                                                <option value="confirmed" <?= $order['status'] === 'confirmed' ? 'selected' : '' ?>>
                                                    Đã xác nhận
                                                </option>
                                                <option value="shipping" <?= $order['status'] === 'shipping' ? 'selected' : '' ?>>
                                                    Đang giao
                                                </option>
                                                <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>
                                                    Đã giao
                                                </option>
                                                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>
                                                    Đã hủy
                                                </option>
                                            </select>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <a href="orders.php" class="btn btn-outline-secondary">Quay lại</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Thông tin giao hàng -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Thông tin giao hàng</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-3">Người nhận</dt>
                                        <dd class="col-sm-9"><?= htmlspecialchars($order['recipient']) ?></dd>

                                        <dt class="col-sm-3">Địa chỉ</dt>
                                        <dd class="col-sm-9"><?= nl2br(htmlspecialchars($order['address'])) ?></dd>

                                        <dt class="col-sm-3">Ghi chú</dt>
                                        <dd class="col-sm-9"><?= htmlspecialchars($order['note'] ?: '-') ?></dd>

                                        <dt class="col-sm-3">Phương thức TT</dt>
                                        <dd class="col-sm-9"><?= htmlspecialchars($payment_map[$order['payment_method']] ?? $order['payment_method']) ?></dd>

                                        <dt class="col-sm-3">Ngày đặt</dt>
                                        <dd class="col-sm-9"><?= date('d/m/Y H:i:s', strtotime($order['created_at'])) ?></dd>
                                        <?php if ($order['status'] === 'received') : ?>
                                            <dt class="col-sm-3">Ngày nhận hàng</dt>
                                            <dd class="col-sm-9"><?= date('d/m/Y H:i:s', strtotime($order['received_at'])) ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Chi tiết tài chính -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Chi tiết tài chính</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tổng tiền hàng</span>
                                        <span><?= number_format($order['total_price'], 0, ',', '.') ?> đ</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Phí giao hàng</span>
                                        <span>0 đ</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Giảm giá</span>
                                        <span>0 đ</span>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span>Tổng cộng</span>
                                        <span class="text-danger"><?= number_format($order['total_price'], 0, ',', '.') ?> đ</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Danh sách sản phẩm -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Sản phẩm</h5>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        try {
                                            $sql = "SELECT od.*, p.title, p.image 
                                                FROM order_detail od
                                                LEFT JOIN product p ON od.product_id = p.id
                                                WHERE od.order_id = ?";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute([$order['id']]);
                                            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($items as $item) {
                                        ?>
                                                <li class="list-group-item">
                                                    <div class="d-flex gap-2 align-items-start">
                                                        <img src="../products/<?= htmlspecialchars($item['image']) ?>" alt=""
                                                            style="width:50px;height:50px;object-fit:contain;" class="rounded border">
                                                        <div class="flex-grow-1">
                                                            <div class="small fw-semibold"><?= htmlspecialchars($item['title'] ?? 'Sản phẩm') ?></div>
                                                            <div class="text-muted small">
                                                                <?= number_format($item['price'], 0, ',', '.') ?> đ × <?= (int)$item['quantity'] ?>
                                                            </div>
                                                        </div>
                                                        <div class="text-danger fw-semibold"><?= number_format($item['total'], 0, ',', '.') ?> đ</div>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        } catch (Exception $e) {
                                            echo '<li class="list-group-item text-danger">Lỗi load sản phẩm</li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>


    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>