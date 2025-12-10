<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$orders = [];
$err = '';
$filter_status = isset($_GET['status']) && !empty($_GET['status']) ? $_GET['status'] : '';
$search_q = isset($_GET['q']) && !empty($_GET['q']) ? trim($_GET['q']) : '';

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
            END as status_name
            FROM orders o
            JOIN users u ON o.user_id = u.id
            WHERE 1=1";
    
    $params = [];

    // Lọc theo trạng thái
    if (!empty($filter_status)) {
        $sql .= " AND o.status = ?";
        $params[] = $filter_status;
    }

    // Tìm kiếm theo mã đơn hoặc tên khách
    if (!empty($search_q)) {
        $sql .= " AND (o.id LIKE ? OR u.fullname LIKE ? OR u.email LIKE ? OR o.recipient LIKE ?)";
        $search_param = '%' . $search_q . '%';
        $params[] = $search_param;
        $params[] = $search_param;
        $params[] = $search_param;
        $params[] = $search_param;
    }

    $sql .= " ORDER BY o.created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $err = $e->getMessage();
}

// Map status để hiển thị
$status_options = [
    '' => 'Tất cả trạng thái',
    'pending' => 'Chờ xử lý',
    'confirmed' => 'Đã xác nhận',
    'shipping' => 'Đang giao',
    'delivered' => 'Đã giao',
    'cancelled' => 'Đã hủy'
];
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
                                    <form method="GET" action="" class="row g-3 justify-content-between">
                                        <div class="col-md-5 col-12">
                                            <!-- Tìm kiếm -->
                                            <div class="input-group">
                                                <input 
                                                    class="form-control" 
                                                    type="search" 
                                                    name="q"
                                                    placeholder="Tìm mã đơn, tên khách hàng, email..." 
                                                    value="<?= htmlspecialchars($search_q) ?>"
                                                    aria-label="Search" 
                                                />
                                                <button class="btn btn-outline-secondary" type="submit">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <!-- Lọc trạng thái -->
                                            <select name="status" class="form-select" onchange="this.form.submit()">
                                                <?php foreach ($status_options as $val => $label): ?>
                                                    <option value="<?= htmlspecialchars($val) ?>" <?= $filter_status === $val ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($label) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-12 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary flex-grow-1">
                                                <i class="bi bi-funnel me-2"></i>Lọc
                                            </button>
                                            <a href="orders.php" class="btn btn-outline-secondary">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <!-- card body -->
                                <div class="card-body p-0">
                                    <?php if (!empty($err)): ?>
                                        <div class="alert alert-danger m-4"><?= htmlspecialchars($err) ?></div>
                                    <?php endif; ?>

                                    <!-- Hiển thị filter đang áp dụng -->
                                    <?php if (!empty($filter_status) || !empty($search_q)): ?>
                                        <div class="p-4 bg-light border-bottom">
                                            <p class="mb-2 small"><strong>Bộ lọc hiện tại:</strong></p>
                                            <div class="d-flex flex-wrap gap-2">
                                                <?php if (!empty($filter_status)): ?>
                                                    <span class="badge bg-primary">
                                                        Trạng thái: <?= htmlspecialchars($status_options[$filter_status]) ?>
                                                        <a href="?q=<?= urlencode($search_q) ?>" class="text-white ms-2 text-decoration-none">×</a>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if (!empty($search_q)): ?>
                                                    <span class="badge bg-info">
                                                        Tìm: "<?= htmlspecialchars($search_q) ?>"
                                                        <a href="?status=<?= urlencode($filter_status) ?>" class="text-white ms-2 text-decoration-none">×</a>
                                                    </span>
                                                <?php endif; ?>
                                                <a href="orders.php" class="btn btn-sm btn-outline-secondary">Xóa tất cả</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- table responsive -->
                                    <div class="table-responsive">
                                        <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Khách hàng</th>
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
                                                        <td colspan="7" class="text-center py-5">
                                                            <p class="text-muted">
                                                                <?php if (!empty($search_q) || !empty($filter_status)): ?>
                                                                    Không tìm thấy đơn hàng nào với bộ lọc hiện tại
                                                                <?php else: ?>
                                                                    Chưa có đơn hàng nào
                                                                <?php endif; ?>
                                                            </p>
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
                                                                <div>
                                                                    <p class="mb-1"><?= htmlspecialchars($order['fullname']) ?></p>
                                                                    <p class="text-muted small mb-0"><?= htmlspecialchars($order['email']) ?></p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                                                            </td>
                                                            <td class="small">
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
                                                                            <a class="dropdown-item text-danger" href="delete-order.php?id=<?= $order['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
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