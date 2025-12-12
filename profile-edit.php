<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = (int)$_SESSION['user_id'];
$err = '';
$msg = '';

// Lấy thông tin hiện tại
try {
    $stmt = $pdo->prepare("SELECT id, username, fullname, email, phone, address FROM users WHERE id = ? LIMIT 1");
    $stmt->execute([$uid]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $err = 'Không tìm thấy người dùng.';
    }
} catch (PDOException $e) {
    $err = 'Lỗi hệ thống: ' . $e->getMessage();
}

// Xử lý POST (không dùng AJAX/JS)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($err)) {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validate cơ bản
    if ($username === '' || $fullname === '' || $email === '') {
        $err = 'Vui lòng điền đầy đủ các trường bắt buộc.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = 'Email không hợp lệ.';
    } elseif ($password !== '' && $password !== $password_confirm) {
        $err = 'Mật khẩu xác nhận không khớp.';
    } else {
        try {
            // Kiểm tra trùng username/email (ngoại trừ bản thân)
            $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ? LIMIT 1");
            $stmt->execute([$username, $email, $uid]);
            if ($stmt->fetch()) {
                $err = 'Tên đăng nhập hoặc email đã được sử dụng bởi người khác.';
            } else {
                // Build update
                $sql = "UPDATE users SET username = :username, fullname = :fullname, email = :email, phone = :phone, address = :address";
                $params = [
                    ':username' => $username,
                    ':fullname' => $fullname,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':address' => $address,
                    ':id' => $uid
                ];
                if ($password !== '') {
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $sql .= ", password = :password";
                    $params[':password'] = $hash;
                }
                $sql .= " WHERE id = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);

                // Cập nhật session
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;

                // Làm mới dữ liệu hiển thị trên form
                $user['username'] = $username;
                $user['fullname'] = $fullname;
                $user['email'] = $email;
                $user['phone'] = $phone;
                $user['address'] = $address;

                $msg = 'Cập nhật thông tin thành công.';
            }
        } catch (PDOException $e) {
            $err = 'Lỗi hệ thống: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Chỉnh sửa thông tin - UniBook</title>
    <?php include('include/lib.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>
<div class="mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                     <li class="breadcrumb-item"><a href="profile.php">Thông tin tài khoản</a></li>
                    <li class="breadcrumb-item active">Chỉnh sửa tài khoản</li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="container my-5">

        <!-- Notification -->
        <?php if ($err): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>
        <?php if ($msg): ?>
            <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <div class="row">

            <?php include('include/sidebar.php') ?>

            <!-- MAIN FORM -->
            <div class="col-md-9">
                <div class="card bg-white border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">Chỉnh sửa thông tin</h5>

                        <form method="POST" action="" class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Tên đăng nhập *</label>
                                <input name="username" type="text" class="form-control"
                                    value="<?= htmlspecialchars($user['username']) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Họ và tên *</label>
                                <input name="fullname" type="text" class="form-control"
                                    value="<?= htmlspecialchars($user['fullname']) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email *</label>
                                <input name="email" type="email" class="form-control"
                                    value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Số điện thoại</label>
                                <input name="phone" type="text" class="form-control"
                                    value="<?= htmlspecialchars($user['phone']) ?>">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold">Địa chỉ</label>
                                <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($user['address']) ?></textarea>
                            </div>

                            <hr class="mt-4">

                            <h6 class="fw-bold mt-2 mb-3">Đổi mật khẩu</h6>

                            <div class="col-md-6">
                                <label class="form-label small">Mật khẩu mới</label>
                                <input name="password" type="password" class="form-control"
                                    placeholder="Để trống nếu không đổi">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small">Xác nhận mật khẩu</label>
                                <input name="password_confirm" type="password" class="form-control">
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-4 gap-2">
                                <a href="my-info.php" class="btn btn-outline-secondary">Hủy</a>
                                <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </main>


    <?php include('footer.php'); ?>
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>