<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
/* ==================== CẬP NHẬT TRẠNG THÁI ĐÃ NHẬN HÀNG ==================== */
if (isset($_GET['action']) && $_GET['action'] === 'received' && isset($_GET['id'])) {
    $order_id = $_GET['id'];

    try {
        // Kiểm tra đơn hàng có tồn tại và thuộc về user này không + trạng thái đúng
        $check = $pdo->prepare("SELECT status FROM orders WHERE id = ? AND user_id = ?");
        $check->execute([$order_id, $_SESSION['user_id']]);
        $order = $check->fetch();

        if (!$order) {
            $_SESSION['msg'] = '<div class="alert alert-danger">Đơn hàng không tồn tại hoặc không phải của bạn!</div>';
        } elseif ($order['status'] !== 'delivered') {
            $_SESSION['msg'] = '<div class="alert alert-warning">Chỉ có thể xác nhận khi đơn hàng đã được giao.</div>';
        } else {
            // Cập nhật trạng thái
            $date_now = date('Y-m-d H:i:s');
            $update = $pdo->prepare("UPDATE orders SET status = 'received', received_at = ? WHERE id = ?");
            $update->execute([$date_now,$order_id]);

            $_SESSION['msg'] = '<div class="alert alert-success">Cảm ơn bạn! Đơn hàng đã được đánh dấu là ĐÃ NHẬN HÀNG.</div>';
        }
    } catch (Exception $e) {

        $_SESSION['msg'] = '<div class="alert alert-danger"> Có lỗi xảy ra, vui lòng thử lại.</div>';
        $_SESSION['msg'] .= $e->getMessage();
    }

    // Quay lại trang danh sách đơn hàng
    header("Location: order-list.php");
    exit;
}

/* ==================== LẤY DANH SÁCH ĐƠN HÀNG ==================== */
$orders = [];
$err = '';

try {
    $sql = "SELECT o.*,
                   (SELECT p.title FROM order_detail od JOIN product p ON od.product_id = p.id WHERE od.order_id = o.id LIMIT 1) AS first_product_title,
                   (SELECT p.image FROM order_detail od JOIN product p ON od.product_id = p.id WHERE od.order_id = o.id LIMIT 1) AS first_product_image,
                   (SELECT SUM(quantity) FROM order_detail WHERE order_id = o.id) AS items_count
            FROM orders o
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $err = $e->getMessage();
}

// Map trạng thái
$status_map = [
    'pending'    => ['label' => 'Chờ xử lý',      'class' => 'bg-warning text-dark'],
    'confirmed'  => ['label' => 'Đã xác nhận',    'class' => 'bg-primary text-white'],
    'shipping'   => ['label' => 'Đang giao',      'class' => 'bg-info text-dark'],
    'delivered'  => ['label' => 'Đã giao hàng',   'class' => 'bg-secondary text-white'],
    'received'   => ['label' => 'Đã nhận hàng',   'class' => 'bg-success text-white'],
    'cancelled'  => ['label' => 'Đã hủy',         'class' => 'bg-danger text-white'],
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
        .order-card .thumb {width:80px;height:80px;object-fit:contain;}
        .order-card .meta {font-size:0.9rem;color:#6c757d;}
        .order-card .amount {font-size:1.05rem;}
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="mt-4"><div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đơn hàng của tôi</li>
            </ol>
        </nav>
    </div></div>

    <main class="container my-5">
        <div class="row">
            <?php include('include/sidebar.php') ?>
            <div class="col-md-9">

                <h3 class="mb-4">Đơn hàng của tôi</h3>

                <!-- Thông báo sau khi xác nhận -->
                <?php 
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                if ($err) echo '<div class="alert alert-danger">'.htmlspecialchars($err).'</div>';
                ?>

                <?php if (empty($orders)): ?>
                    <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
                <?php else: ?>
                    <div class="row g-3">
                        <?php foreach ($orders as $o): 
                            $sdata = $status_map[$o['status']] ?? ['label' => $o['status'], 'class' => 'bg-secondary'];
                        ?>
                            <div class="col-12">
                                <div class="card order-card shadow-sm">
                                    <div class="card-body d-flex gap-3 align-items-center">

                                        <?php if (!empty($o['first_product_image'])): ?>
                                            <img class="thumb rounded border" src="products/<?=htmlspecialchars($o['first_product_image'])?>" alt="">
                                        <?php else: ?>
                                            <div class="thumb rounded border bg-light d-flex align-items-center justify-content-center text-muted">No Img</div>
                                        <?php endif; ?>

                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <a class="h6 mb-0 text-decoration-none" href="order-detail.php?id=<?=urlencode($o['id'])?>">
                                                        #<?=str_pad($o['id'], 6, '0', STR_PAD_LEFT)?>
                                                    </a>
                                                    <div class="meta mt-1">
                                                        <?=htmlspecialchars($o['first_product_title'] ?? '—')?>
                                                        · <?=($o['items_count'] ?? 0)?> sản phẩm
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge <?= $sdata['class'] ?> px-3"><?= $sdata['label'] ?></span><br>
                                                    <strong class="text-danger"><?=number_format($o['total_price'],0,',','.')?> đ</strong><br>
                                                    <small><?=date('d/m/Y H:i', strtotime($o['created_at']))?></small>
                                                </div>
                                            </div>

                                            <div class="mt-3 d-flex gap-2">
                                                <a href="order-detail.php?id=<?=urlencode($o['id'])?>" class="btn btn-sm btn-outline-primary">
                                                    Xem chi tiết
                                                </a>

                                                <!-- Nút ĐÃ NHẬN HÀNG - chỉ hiện khi đang "delivered" -->
                                                <?php if ($o['status'] === 'delivered'): ?>
                                                    <a href="order-list.php?action=received&id=<?=urlencode($o['id'])?>" 
                                                       class="btn btn-sm btn-success"
                                                       onclick="return confirm('Bạn đã nhận được hàng và muốn xác nhận hoàn tất đơn hàng này?')">
                                                        Đã nhận hàng
                                                    </a>
                                                <?php elseif ($o['status'] === 'received'): ?>
                                                    <button class="btn btn-sm btn-secondary" disabled>Đã nhận hàng</button>
                                                <?php endif; ?>
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