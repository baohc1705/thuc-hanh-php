<?php
include('config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = null;
$err = '';

try {
    $sql = "SELECT id, username, fullname, email, phone, address, role, status, created_at
            FROM users WHERE id = ? LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $err = 'Không tìm thấy thông tin người dùng.';
    }
} catch (PDOException $e) {
    $err = 'Lỗi hệ thống: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Thông tin tài khoản - UniBook</title>
    <?php include('include/lib.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thông tin tài khoản</li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="container my-5">

        <?php if ($err): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
        <?php else: ?>

            <div class="row">

              <?php include('include/sidebar.php') ?>

                <!-- NỘI DUNG CHÍNH -->
                <div class="col-lg-9">

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h5 class="fw-bold mb-0">Thông tin cá nhân</h5>
                                    <p class="text-muted small">Quản lý thông tin để bảo vệ tài khoản của bạn</p>
                                </div>
                                <a href="profile-edit.php" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
                                </a>
                            </div>

                            <!-- Thông tin -->
                            <dl class="row small mb-0">
                                <dt class="col-sm-3 mb-2">Tên đăng nhập</dt>
                                <dd class="col-sm-9 mb-2"><?= htmlspecialchars($user['username']) ?></dd>

                                <dt class="col-sm-3 mb-2">Họ và tên</dt>
                                <dd class="col-sm-9 mb-2"><?= htmlspecialchars($user['fullname'] ?: '-') ?></dd>

                                <dt class="col-sm-3 mb-2">Email</dt>
                                <dd class="col-sm-9 mb-2"><?= htmlspecialchars($user['email']) ?></dd>

                                <dt class="col-sm-3 mb-2">Số điện thoại</dt>
                                <dd class="col-sm-9 mb-2"><?= htmlspecialchars($user['phone'] ?: '-') ?></dd>

                                <dt class="col-sm-3 mb-2">Địa chỉ</dt>
                                <dd class="col-sm-9 mb-2"><?= nl2br(htmlspecialchars($user['address'] ?: '-')) ?></dd>

                                <dt class="col-sm-3 mb-2">Vai trò</dt>
                                <dd class="col-sm-9 mb-2">
                                    <span class="badge bg-light text-dark border">
                                        <?= $user['role'] ? 'Quản trị viên' : 'Khách hàng' ?>
                                    </span>
                                </dd>

                                <dt class="col-sm-3 mb-2">Trạng thái</dt>
                                <dd class="col-sm-9 mb-2">
                                    <span class="badge <?= $user['status'] ? 'bg-success' : 'bg-warning text-dark' ?>">
                                        <?= $user['status'] ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                    </span>
                                </dd>

                                <dt class="col-sm-3 mb-2">Ngày tạo</dt>
                                <dd class="col-sm-9 mb-2"><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></dd>
                            </dl>

                        </div>
                    </div>

                    

                </div>

            </div>
        <?php endif; ?>
    </main>


    <?php include('footer.php'); ?>
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>