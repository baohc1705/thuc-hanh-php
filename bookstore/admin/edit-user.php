<?php
include('../config/config.php');

$err = "";

// -------------------- LOAD USER --------------------
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? 0;
    try {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Người dùng không tồn tại!");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -------------------- UPDATE USER --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validate dữ liệu
    if (empty($username)) {
        $err = "Vui lòng nhập tên đăng nhập!";
    } elseif (empty($fullname)) {
        $err = "Vui lòng nhập họ tên!";
    } elseif (empty($email)) {
        $err = "Vui lòng nhập email!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Email không hợp lệ!";
    } elseif (!empty($password) && $password !== $password_confirm) {
        $err = "Mật khẩu xác nhận không khớp!";
    }

    // Kiểm tra username đã tồn tại (ngoại trừ user hiện tại)
    if (empty($err)) {
        try {
            $sql = "SELECT id FROM users WHERE username = ? AND id != ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $id]);
            if ($stmt->fetch()) {
                $err = "Tên đăng nhập đã tồn tại!";
            }
        } catch (PDOException $e) {
            $err = "Lỗi kiểm tra tên đăng nhập: " . $e->getMessage();
        }
    }

    // Update DB
    if (empty($err)) {
        try {
            // Nếu có thay đổi mật khẩu
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users 
                        SET username = ?, fullname = ?, email = ?, phone = ?, address = ?, role = ?, status = ?, password = ?
                        WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $fullname, $email, $phone, $address, $role, $status, $hashedPassword, $id]);
            } else {
                // Không thay đổi mật khẩu
                $sql = "UPDATE users 
                        SET username = ?, fullname = ?, email = ?, phone = ?, address = ?, role = ?, status = ?
                        WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $fullname, $email, $phone, $address, $role, $status, $id]);
            }

            header("Location: users.php?update=success");
            exit;
        } catch (PDOException $e) {
            $err = "Lỗi cập nhật: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chỉnh sửa người dùng</title>
    <?php include("include/lib.php"); ?>
</head>

<body>
    <!-- main layout -->
    <div>
        <?php include('header.php') ?>
        <div class="main-wrapper">
            <?php include('sidebar.php') ?>

            <main class="main-content-wrapper">
                <div class="container">
                    <h2 class="mb-5">Chỉnh sửa người dùng</h2>

                    <?php if (!empty($err)): ?>
                        <div class="alert alert-danger"><?= $err ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-8">

                            <div class="card">
                                <div class="card-body">

                                    <form action="edit-user.php" method="POST">

                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">

                                        <!-- Tên đăng nhập -->
                                        <div class="mb-3">
                                            <label class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                                            <input name="username" type="text" class="form-control" value="<?= $user['username'] ?>" required>
                                        </div>

                                        <!-- Họ tên -->
                                        <div class="mb-3">
                                            <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                                            <input name="fullname" type="text" class="form-control" value="<?= $user['fullname'] ?>" required>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input name="email" type="email" class="form-control" value="<?= $user['email'] ?>" required>
                                        </div>

                                        <!-- Số điện thoại -->
                                        <div class="mb-3">
                                            <label class="form-label">Số điện thoại</label>
                                            <input name="phone" type="text" class="form-control" value="<?= $user['phone'] ?>">
                                        </div>

                                        <!-- Địa chỉ -->
                                        <div class="mb-3">
                                            <label class="form-label">Địa chỉ</label>
                                            <input name="address" type="text" class="form-control" value="<?= $user['address'] ?>">
                                        </div>

                                        <!-- Mật khẩu -->
                                        <div class="mb-3">
                                            <label class="form-label">Mật khẩu</label>
                                            <input name="password" type="password" class="form-control" placeholder="Để trống nếu không muốn đổi">
                                            <small class="text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
                                        </div>

                                        <!-- Xác nhận mật khẩu -->
                                        <div class="mb-3">
                                            <label class="form-label">Xác nhận mật khẩu</label>
                                            <input name="password_confirm" type="password" class="form-control" placeholder="Để trống nếu không muốn đổi">
                                        </div>

                                        <!-- Quyền -->
                                        <div class="mb-3">
                                            <label class="form-label">Quyền</label>
                                            <select name="role" class="form-control">
                                                <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>Khách hàng</option>
                                                <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Quản trị viên</option>
                                            </select>
                                        </div>

                                        <!-- Trạng thái -->
                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                                <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Vô hiệu hóa</option>
                                            </select>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                            <a href="users.php" class="btn btn-secondary">Hủy</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hiển thị thông tin -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Thông tin hiện tại</h5>
                                    
                                    <div class="mb-3">
                                        <p class="text-muted mb-1 small">Tên đăng nhập:</p>
                                        <p class="fw-semibold"><?= $user['username'] ?></p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted mb-1 small">Họ tên:</p>
                                        <p class="fw-semibold"><?= $user['fullname'] ?></p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted mb-1 small">Email:</p>
                                        <p class="fw-semibold"><?= $user['email'] ?></p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted mb-1 small">Quyền:</p>
                                        <p>
                                            <span class="<?= $user['role'] ? 'badge bg-light-danger text-dark-danger' : 'badge bg-light-primary text-dark-primary' ?>">
                                                <?= $user['role'] ? 'Quản trị viên' : 'Khách hàng' ?>
                                            </span>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted mb-1 small">Trạng thái:</p>
                                        <p>
                                            <span class="<?= $user['status'] ? 'badge bg-light-success text-dark-success' : 'badge bg-light-warning text-dark-warning' ?>">
                                                <?= $user['status'] ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                            </span>
                                        </p>
                                    </div>

                                    <div class="mb-2">
                                        <p class="text-muted mb-1 small">Ngày tạo:</p>
                                        <p class="fw-semibold"><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../js/theme.min.js"></script>
</body>

</html>