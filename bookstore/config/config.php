<?php
// Kiểm tra đang chạy trên localhost hay hosting
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
    // Cấu hình khi chạy local
    $host = 'localhost';
    $dbname = 'bookstore';
    $username = 'root';
    $password = '';
} else {
    // Cấu hình khi chạy trên hosting InfinityFree
    $host = 'sql202.infinityfree.com';
    $dbname = 'if0_40390960_bookstore';
    $username = 'if0_40390960';
    $password = 'huynhchibao';
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Chế độ báo lỗi
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
