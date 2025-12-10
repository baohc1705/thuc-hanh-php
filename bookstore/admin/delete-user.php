<?php
include("../config/config.php");

$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';

if ($action === 'delete' && $id > 0) {

    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: users.php?delete=success");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        exit;
    }
}

try {
    $sql = "SELECT * FROM users WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Không tìm thấy người dùng.";
        exit;
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Xóa người dùng - Unibook</title>
    <?php include("include/lib.php"); ?>
</head>

<body>
    <!-- main layout -->
    <div>
        <?php include('header.php') ?>
        <div class="main-wrapper">
            <?php include('sidebar.php') ?>

            <main class="main-content-wrapper">
                <div class="container py-5">

                    <!-- Title -->
                    <div class="row mb-8">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h2>Xóa người dùng</h2>
                            <a href="users.php" class="btn btn-primary">Trở về</a>
                        </div>
                    </div>

                    <!-- Delete Card -->
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-lg-6">
                            <div class="card shadow-lg">

                                <div class="card-body text-center">

                                    <!-- Icon -->
                                    <i class="bi bi-exclamation-triangle-fill fs-1 mb-3 text-warning"></i>

                                    <h3 class="fw-bold mb-3">Bạn có chắc chắn muốn xóa?</h3>

                                    <p class="mb-4">
                                        Thao tác này sẽ xóa vĩnh viễn người dùng khỏi hệ thống.
                                    </p>

                                    <!-- Thông tin user -->
                                    <div class="p-3 bg-light text-start mb-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-1 fw-semibold">Tên đăng nhập:</p>
                                                <p class="mb-3"><?= $user['username'] ?></p>

                                                <p class="mb-1 fw-semibold">Họ tên:</p>
                                                <p class="mb-3"><?= $user['fullname'] ?></p>

                                                <p class="mb-1 fw-semibold">Email:</p>
                                                <p class="mb-3"><?= $user['email'] ?></p>

                                                <p class="mb-1 fw-semibold">Số điện thoại:</p>
                                                <p class="mb-3"><?= $user['phone'] ?: '<i>Không có</i>' ?></p>

                                                <p class="mb-1 fw-semibold">Địa chỉ:</p>
                                                <p class="mb-3"><?= $user['address'] ?: '<i>Không có</i>' ?></p>

                                                <p class="mb-1 fw-semibold">Quyền:</p>
                                                <p class="mb-3">
                                                    <span class="<?= $user['role'] ? 'badge bg-light-danger text-dark-danger' : 'badge bg-light-primary text-dark-primary' ?>">
                                                        <?= $user['role'] ? 'Quản trị viên' : 'Khách hàng' ?>
                                                    </span>
                                                </p>

                                                <p class="mb-1 fw-semibold">Trạng thái:</p>
                                                <p>
                                                    <span class="<?= $user['status'] ? 'badge bg-light-success text-dark-success' : 'badge bg-light-warning text-dark-warning' ?>">
                                                        <?= $user['status'] ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                                                    </span>
                                                </p>

                                                <p class="mb-2 fw-semibold">Ngày tạo:</p>
                                                <p><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-between gap-3">
                                        <a href="users.php" class="btn btn-light">Quay lại</a>

                                        <a href="delete-user.php?action=delete&id=<?= $user['id'] ?>"
                                            class="btn btn-danger">
                                            Xóa ngay
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../js/theme.min.js"></script>

</body>

</html>