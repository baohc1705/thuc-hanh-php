<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$orders = [];
$err = '';

try {
    $sql = "SELECT o.*,
                   (SELECT p.title FROM order_detail od JOIN product p ON od.product_id = p.id WHERE od.order_id = o.id LIMIT 1) AS first_product_title,
                   (SELECT p.image FROM order_detail od JOIN product p ON od.product_id = p.id WHERE od.order_id = o.id LIMIT 1) AS first_product_image,
                   (SELECT SUM(quantity) FROM order_detail WHERE order_id = o.id) AS items_count,
                   CASE 
                     WHEN o.payment_method = 'cod' THEN 'Thanh toán khi nhận hàng'
                     WHEN o.payment_method = 'vnpay' THEN 'Chuyển khoản ngân hàng'
                     ELSE 'Không xác định'
                   END AS payment_name
            FROM orders o
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $err = $e->getMessage();
}

// map trạng thái -> label + màu
$status_map = [
    'pending' => ['label' => 'Chờ xử lý', 'class' => 'bg-warning text-dark'],
    'confirmed' => ['label' => 'Đã xác nhận', 'class' => 'bg-primary text-white'],
    'shipping' => ['label' => 'Đang giao', 'class' => 'bg-info text-dark'],
    'delivered' => ['label' => 'Đã giao', 'class' => 'bg-success text-white'],
    'cancelled' => ['label' => 'Đã hủy', 'class' => 'bg-danger text-white'],
];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Đơn hàng của tôi - UniBook</title>
    <?php include('include/lib.php'); ?>
    <style>
        .order-card .thumb {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .order-card .meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .order-card .amount {
            font-size: 1.05rem;
        }

        @media (max-width: 767px) {
            .order-card {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <!-- Breadcrumb -->
    <div class="mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đơn hàng của tôi</li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="container my-5">
        <div class="row">
            <?php include('include/sidebar.php') ?>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-0">Đơn hàng của tôi</h3>
                        <small class="text-muted">Quản lý và theo dõi trạng thái đơn hàng</small>
                    </div>
                    <div class="d-flex gap-2">
                        <form class="d-flex" method="GET" action="order-list.php" role="search">
                            <input name="q" class="form-control form-control-sm" type="search" placeholder="Tìm mã đơn / tên sản phẩm" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" />
                        </form>
                    </div>
                </div>

                <?php if ($err): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
                <?php endif; ?>

                <?php if (empty($orders)): ?>
                    <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
                <?php else: ?>
                    <div class="row g-3">
                        <?php foreach ($orders as $o):
                            $sdata = $status_map[$o['status']] ?? ['label' => $o['status'], 'class' => 'bg-secondary text-white'];
                        ?>
                            <div class="col-12">
                                <div class="card order-card shadow-sm">
                                    <div class="card-body d-flex gap-3 align-items-center">
                                        <div class="d-flex align-items-center">
                                            <?php if (!empty($o['first_product_image'])): ?>
                                                <img class="thumb rounded border me-3" src="products/<?= htmlspecialchars($o['first_product_image']) ?>" alt="<?= htmlspecialchars($o['first_product_title']) ?>">
                                            <?php else: ?>
                                                <div class="thumb rounded border bg-light me-3 d-flex align-items-center justify-content-center text-muted">No Img</div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="d-sm-flex justify-content-between align-items-start">
                                                <div>
                                                    <a class="h6 mb-0 d-inline-block text-decoration-none" href="order-detail.php?id=<?= urlencode($o['id']) ?>">
                                                        #<?= str_pad($o['id'], 6, '0', STR_PAD_LEFT) ?>
                                                    </a>
                                                    <div class="meta mt-1">
                                                        <span><?= htmlspecialchars($o['first_product_title'] ?? '—') ?></span>
                                                        <span class="mx-2">·</span>
                                                        <span><?= (int)($o['items_count'] ?? 0) ?> sản phẩm</span>
                                                    </div>
                                                </div>

                                                <div class="text-end">
                                                    <div class="mb-2">
                                                        <span class="badge px-3 <?= $sdata['class'] ?>"><?= htmlspecialchars($sdata['label']) ?></span>
                                                    </div>
                                                    <div class="amount text-danger fw-bold"><?= number_format((float)$o['total_price'], 0, ',', '.') ?> đ</div>
                                                    <div class="meta"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 mt-3">
                                                <a href="order-detail.php?id=<?= urlencode($o['id']) ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>

                                                <?php if (in_array($o['status'], ['shipping', 'delivered'])): ?>
                                                    <a href="track-order.php?id=<?= urlencode($o['id']) ?>" class="btn btn-sm btn-outline-info">Theo dõi</a>
                                                <?php endif; ?>

                                                <a href="repeat-order.php?order_id=<?= urlencode($o['id']) ?>" class="btn btn-sm btn-outline-secondary">Mua lại</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <?php include('footer.php'); ?>
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>