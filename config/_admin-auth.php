<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chưa đăng nhập → redirect login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Không phải admin (role != 1) → redirect trang chủ
if (empty($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    http_response_code(403);
    die('<div style="text-align:center;padding:50px;"><h2>Truy cập bị từ chối</h2><p>Bạn không có quyền truy cập vào khu vực này.</p><a href="../index.php">← Quay lại trang chủ</a></div>');
}
?>