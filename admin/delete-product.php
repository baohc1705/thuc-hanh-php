<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';

if ($action === 'delete' && $id > 0) {

    try {
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: products.php?delete=success");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        exit;
    }
}

try {
    $sql = "SELECT p.*, c.name as category_name 
            FROM product p 
            LEFT JOIN category c on p.category_id = c.id 
            WHERE p.id = :id";

    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(['id' => $id]);
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$prod) {
        echo "Không tìm thấy sản phẩm.";
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
    <title>Xóa sản phẩm - Unibook</title>
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
                            <h2>Xóa sản phẩm</h2>
                            <a href="products.php" class="btn btn-primary">Trở về</a>
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
                                        Thao tác này sẽ xóa vĩnh viễn sản phẩm khỏi hệ thống.
                                    </p>

                                    <!-- Thông tin product -->
                                    <div class="p-3  text-start mb-4">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-1 fw-semibold">Tiêu đề sản phẩm:</p>
                                                <p class="mb-3"><?= $prod['title'] ?></p>

                                                <p class="mb-1 fw-semibold">Danh mục:</p>
                                                <p class="mb-3"><?= $prod['category_name'] ?: '<i>Không có danh mục</i>' ?></p>

                                                <p class="mb-1 fw-semibold">Giá:</p>
                                                <p class="mb-3"><?= number_format($prod['price'], 0, ',', '.') ?> đ</p>

                                                <p class="mb-1 fw-semibold">Số lượng:</p>
                                                <p class="mb-3"><?= $prod['stock'] ?></p>

                                                <p class="mb-2 fw-semibold">Trạng thái:</p>
                                                <p><span class="<?= $prod['status'] ? 'badge bg-light-primary text-dark-primary' : 'badge bg-light-danger text-dark-danger' ?>"><?= $prod['status'] ? 'Hoạt động' : 'Không hoạt động' ?></span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1 fw-semibold">Ảnh sản phẩm:</p>
                                                <img src="../products/<?= $prod['image'] ?>" alt="<?= $prod['image'] ?>" width="100" class="object-fit-contain">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-between">
                                        <a href="products.php" class="btn btn-light">Quay lại</a>

                                        <a href="delete-product.php?action=delete&id=<?= $prod['id'] ?>"
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