<?php
$host = 'sql202.infinityfree.com'; // Địa chỉ máy chủ cơ sở dữ liệu
$dbname = 'if0_40390960_bookstore'; // Tên cơ sở dữ liệu
$username = 'if0_40390960'; // Tên người dùng
$password = 'huynhchibao'; // Mật khẩu

try {
    // Tạo kết nối PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );
    // Thiết lập chế độ lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công!";
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
