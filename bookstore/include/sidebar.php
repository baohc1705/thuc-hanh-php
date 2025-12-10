<?php
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

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- SIDEBAR TRÁI -->
<aside class="col-lg-3">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">

            <!-- Avatar -->
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width:80px;height:80px;font-size:32px;">
                <?= htmlspecialchars(strtoupper(substr($user['fullname'] ?: $user['username'], 0, 1))) ?>
            </div>

            <h6 class="mb-1"><?= htmlspecialchars($user['fullname'] ?: $user['username']) ?></h6>
            <p class="text-muted small mb-3"><?= htmlspecialchars($user['email']) ?></p>

            <hr>

            <!-- Menu -->
            <nav class="nav flex-column small text-start">
                <a href="profile.php"
                    class="nav-link py-2 <?= $current_page == 'profile.php' ? 'active bg-light rounded' : 'text-dark' ?>">
                    <i class="bi bi-person-circle me-2"></i> Thông tin tài khoản
                </a>

                <a href="profile-edit.php"
                    class="nav-link py-2 <?= $current_page == 'profile-edit.php' ? 'active bg-light rounded' : 'text-dark' ?>">
                    <i class="bi bi-pencil-square me-2"></i> Chỉnh sửa hồ sơ
                </a>

                <a href="order-list.php"
                    class="nav-link py-2 <?= $current_page == 'order-list.php' ? 'active bg-light rounded' : 'text-dark' ?>">
                    <i class="bi bi-bag-check me-2"></i> Đơn hàng của tôi
                </a>

                <a href="logout.php" class="nav-link text-danger py-2">
                    <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                </a>

            </nav>

        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h6 class="mb-2">Hỗ trợ</h6>
            <p class="small text-muted">Bạn cần trợ giúp? Chúng tôi luôn sẵn sàng hỗ trợ.</p>
            <a href="contact.php" class="btn btn-outline-primary btn-sm w-100">Liên hệ hỗ trợ</a>
        </div>
    </div>
</aside>