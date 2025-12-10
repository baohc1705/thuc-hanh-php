<?php
include('../config/config.php');

$orders = [];
$err = '';

try {
    $sql = "SELECT o.*, u.fullname, u.email,
            CASE 
                WHEN o.payment_method = 'cod' THEN 'Thanh toán khi nhận hàng'
                WHEN o.payment_method = 'bank_transfer' THEN 'Chuyển khoản ngân hàng'
                ELSE 'Không xác định'
            END as payment_name,
            CASE 
                WHEN o.status = 'pending' THEN 'Chờ xử lý'
                WHEN o.status = 'confirmed' THEN 'Đã xác nhận'
                WHEN o.status = 'shipping' THEN 'Đang giao'
                WHEN o.status = 'delivered' THEN 'Đã giao'
                WHEN o.status = 'cancelled' THEN 'Đã hủy'
                ELSE o.status
            END as status_name,
            (SELECT GROUP_CONCAT(p.title SEPARATOR ', ') 
             FROM order_detail od 
             JOIN product p ON od.product_id = p.id 
             WHERE od.order_id = o.id LIMIT 1) as first_product_image
            FROM orders o
            JOIN users u ON o.user_id = u.id
            ORDER BY o.created_at DESC";

    $stmt = $pdo->query($sql);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $err = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Quản lý đơn hàng - UniBook</title>
    <?php include('include/lib.php') ?>
</head>

<body>
    <!-- main -->
    <div>
        <!-- navbar -->
        <?php include('header.php') ?>

        <div class="main-wrapper">

            <?php include('sidebar.php') ?>

            <!-- main wrapper -->
            <main class="main-content-wrapper">
                <div class="container">
                    <!-- row -->
                    <div class="row mb-8">
                        <div class="col-md-12">
                            <!-- page header -->
                            <div class="d-flex justify-content-between align-items-center">
                                <h2>Quản lý đơn hàng</h2>
                            </div>
                            <!-- breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-xl-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lg">
                                <div class="p-6">
                                    <div class="row justify-content-between">
                                        <div class="col-md-4 col-12 mb-2 mb-md-0">
                                            <!-- form -->
                                            <form class="d-flex" role="search">
                                                <input class="form-control" type="search" placeholder="Tìm kiếm đơn hàng" aria-label="Search" />
                                            </form>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-12">
                                            <!-- select -->
                                            <select class="form-select">
                                                <option selected>Trạng thái</option>
                                                <option value="pending">Chờ xử lý</option>
                                                <option value="confirmed">Đã xác nhận</option>
                                                <option value="shipping">Đang giao</option>
                                                <option value="delivered">Đã giao</option>
                                                <option value="cancelled">Đã hủy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-body p-0">
                                    <?php if (!empty($err)): ?>
                                        <div class="alert alert-danger m-4"><?= htmlspecialchars($err) ?></div>
                                    <?php endif; ?>

                                    <!-- table responsive -->
                                    <div class="table-responsive">
                                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Khách hàng</th>
                                                    <th>Email</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Phương thức TT</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng tiền</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($orders)): ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center py-5">
                                                            <p class="text-muted">Chưa có đơn hàng nào</p>
                                                        </td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($orders as $order): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="order-detail.php?id=<?= $order['id'] ?>" class="text-reset fw-semibold">
                                                                    #<?= str_pad($order['id'], 6, '0', STR_PAD_LEFT) ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <span><?= htmlspecialchars($order['fullname']) ?></span>
                                                            </td>
                                                            <td>
                                                                <span class="text-muted"><?= htmlspecialchars($order['email']) ?></span>
                                                            </td>
                                                            <td>
                                                                <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                                                            </td>
                                                            <td>
                                                                <?= htmlspecialchars($order['payment_name']) ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $statusClass = [
                                                                    'pending' => 'bg-light-warning text-dark-warning',
                                                                    'confirmed' => 'bg-light-primary text-dark-primary',
                                                                    'shipping' => 'bg-light-info text-dark-info',
                                                                    'delivered' => 'bg-light-success text-dark-success',
                                                                    'cancelled' => 'bg-light-danger text-dark-danger'
                                                                ];
                                                                $class = $statusClass[$order['status']] ?? 'bg-light-secondary text-dark-secondary';
                                                                ?>
                                                                <span class="badge <?= $class ?>">
                                                                    <?= htmlspecialchars($order['status_name']) ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="fw-bold text-danger">
                                                                    <?= number_format($order['total_price'], 0, ',', '.') ?> đ
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="feather-icon icon-more-vertical fs-5"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a class="dropdown-item" href="order-detail.php?id=<?= $order['id'] ?>">
                                                                                <i class="bi bi-eye me-3"></i>
                                                                                Xem chi tiết
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item" href="edit-order.php?id=<?= $order['id'] ?>">
                                                                                <i class="bi bi-pencil-square me-3"></i>
                                                                                Cập nhật trạng thái
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item text-danger" href="delete-order.php?id=<?= $order['id'] ?>">
                                                                                <i class="bi bi-trash me-3"></i>
                                                                                Xóa
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Tổng cộng: <strong><?= count($orders) ?></strong> đơn hàng</span>
                                    <nav class="mt-2 mt-md-0">
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#!">Trước</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#!">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#!">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#!">Sau</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../js/theme.min.js"></script>

    <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../js/vendors/chart.js"></script>
</body>

</html>