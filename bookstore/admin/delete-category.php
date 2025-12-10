<?php
include("../config/config.php");

$id = $_GET['id'] ?? 0;
$action = $_GET['action'] ?? '';

if ($action === 'delete' && $id > 0) {
    
    try {
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: categories.php?delete=success");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        exit;
    }
}

try {
    $stmt = $pdo->prepare("SELECT * FROM category WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $cate = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cate) {
        echo "Không tìm thấy danh mục.";
        exit;
    }

    // Kiểm tra xem danh mục có sản phẩm nào không
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) as total FROM product WHERE category_id = :id");
    $stmtCheck->execute(['id' => $id]);
    $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    $hasProducts = $result['total'] > 0;

} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Xóa danh mục - Unibook</title>
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
                            <h2>Xóa danh mục</h2>
                            <a href="categories.php" class="btn btn-primary">Trở về</a>
                        </div>
                    </div>

                    <!-- Delete Card -->
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-lg-6">
                            <div class="card shadow-lg">

                                <div class="card-body text-center">

                                    <?php if ($hasProducts): ?>
                                        <!-- Cảnh báo không thể xóa -->
                                        <i class="bi bi-exclamation-circle-fill fs-1 mb-3 text-danger"></i>

                                        <h3 class="fw-bold mb-3 text-danger">Không thể xóa danh mục này</h3>

                                        <p class="mb-4">
                                            Danh mục này vẫn còn chứa sản phẩm. Vui lòng xóa hoặc chuyển hết các sản phẩm sang danh mục khác trước khi xóa danh mục.
                                        </p>

                                        <!-- Thông tin category -->
                                        <div class="p-3  text-start mb-4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="mb-1 fw-semibold">Tên danh mục:</p>
                                                    <p class="mb-3"><?= $cate['name'] ?></p>

                                                    <p class="mb-1 fw-semibold">Mô tả:</p>
                                                    <p class="mb-3"><?= $cate['description'] ?: '<i>Không có mô tả</i>' ?></p>
                                                    <p class="mb-2 fw-semibold">Trạng thái:</p>
                                                    <p><span  class="<?= $cate['status'] ? 'badge bg-light-primary text-dark-primary' : 'badge bg-light-danger text-dark-danger' ?>"><?= $cate['status'] ? 'Hoạt động' : 'Không hoạt động' ?></span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1 fw-semibold">Ảnh danh mục:</p>
                                                    <img src="../images/category/<?= $cate['image'] ?>" alt="<?= $cate['image'] ?>" width="100" class="object-fit-contain">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-center gap-3">
                                            <a href="categories.php" class="btn btn-light">Quay lại</a>
                                        </div>

                                    <?php else: ?>
                                        <!-- Icon -->
                                        <i class="bi bi-exclamation-triangle-fill fs-1 mb-3 text-warning"></i>

                                        <h3 class="fw-bold mb-3">Bạn có chắc chắn muốn xóa?</h3>

                                        <p class="mb-4">
                                            Thao tác này sẽ xóa vĩnh viễn danh mục khỏi hệ thống.
                                        </p>

                                        <!-- Thông tin category -->
                                        <div class="p-3  text-start mb-4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="mb-1 fw-semibold">Tên danh mục:</p>
                                                    <p class="mb-3"><?= $cate['name'] ?></p>

                                                    <p class="mb-1 fw-semibold">Mô tả:</p>
                                                    <p class="mb-3"><?= $cate['description'] ?: '<i>Không có mô tả</i>' ?></p>
                                                    <p class="mb-2 fw-semibold">Trạng thái:</p>
                                                    <p><span  class="<?= $cate['status'] ? 'badge bg-light-primary text-dark-primary' : 'badge bg-light-danger text-dark-danger' ?>"><?= $cate['status'] ? 'Hoạt động' : 'Không hoạt động' ?></span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1 fw-semibold">Ảnh danh mục:</p>
                                                    <img src="../images/category/<?= $cate['image'] ?>" alt="<?= $cate['image'] ?>" width="100" class="object-fit-contain">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-between">
                                            <a href="categories.php" class="btn btn-light">Quay lại</a>

                                            <a href="delete-category.php?action=delete&id=<?= $cate['id'] ?>"
                                                class="btn btn-danger">
                                                Xóa ngay
                                            </a>
                                        </div>

                                    <?php endif; ?>

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