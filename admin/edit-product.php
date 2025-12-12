<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$categories = [];
$err = "";

// -------------------- LOAD PRODUCT --------------------
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? 0;
    try {
        $sql = "SELECT p.*, c.name as category_name 
                FROM product p 
                LEFT JOIN category c on p.category_id = c.id 
                WHERE p.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Sản phẩm không tồn tại!");
        }

        // Lấy danh sách danh mục
        $sql = "SELECT id, name FROM category WHERE status = 1 ORDER BY name";
        $stmt = $pdo->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -------------------- UPDATE PRODUCT --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    // Giữ ảnh cũ
    $currentImage = $_POST['current_image'];
    $newImageName = $currentImage;

    // Validate dữ liệu
    if (empty($title)) {
        $err = "Vui lòng nhập tên sản phẩm!";
    } elseif (empty($price) || $price <= 0) {
        $err = "Vui lòng nhập giá hợp lệ!";
    } elseif (empty($category_id)) {
        $err = "Vui lòng chọn danh mục!";
    } elseif (empty($stock) || $stock <= 0) {
        $err = "Vui lòng nhập số lượng hợp lệ!";
    }

    // Nếu có upload ảnh mới
    if (empty($err) && !empty($_FILES['image']['name'])) {

        $fileName = time() . "_" . $_FILES['image']['name'];
        $targetPath = "../products/" . $fileName;

        // Tạo folder nếu chưa có
        if (!file_exists("../products")) {
            mkdir("../products", 0777, true);
        }

        // Upload thành công
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $newImageName = $fileName;

            // Xóa ảnh cũ nếu tồn tại
            if (!empty($currentImage) && file_exists("../products/" . $currentImage)) {
                unlink("../products/" . $currentImage);
            }
        } else {
            $err = "Upload ảnh thất bại!";
        }
    }

    // Update DB
    if (empty($err)) {
        try {
            $sql = "UPDATE product 
                    SET title = ?, description = ?, price = ?, image = ?, category_id = ?, status = ?, stock = ?
                    WHERE id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $description, $price, $newImageName, $category_id, $status, $stock, $id]);

            header("Location: products.php?update=success");
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
    <title>Chỉnh sửa sản phẩm</title>
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
                    <h2 class="mb-5">Chỉnh sửa sản phẩm</h2>

                    <?php if (!empty($err)): ?>
                        <div class="alert alert-danger"><?= $err ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">

                                    <form action="edit-product.php" method="POST" enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="current_image" value="<?= $product['image'] ?>">

                                        <!-- Tên sản phẩm -->
                                        <div class="mb-3">
                                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                            <input name="title" type="text" class="form-control" value="<?= $product['title'] ?>" required>
                                        </div>

                                        <!-- Danh mục -->
                                        <div class="mb-3">
                                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">-- Chọn danh mục --</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                                        <?= $cat['name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Mô tả -->
                                        <div class="mb-3">
                                            <label class="form-label">Mô tả</label>
                                            <textarea name="description" class="form-control" rows="4"><?= $product['description'] ?></textarea>
                                        </div>

                                        <!-- Giá -->
                                        <div class="mb-3">
                                            <label class="form-label">Giá <span class="text-danger">*</span></label>
                                            <input name="price" type="number" class="form-control" step="0.01" min="0" value="<?= $product['price'] ?>" required>
                                        </div>
                                        <!-- Số lượng -->
                                        <div class="mb-3">
                                            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                                            <input name="stock" type="number" class="form-control" step="1" min="0" value="<?= $product['stock'] ?>" required>
                                        </div>

                                        <!-- Trạng thái -->
                                        <div class="mb-3">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                                <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
                                            </select>
                                        </div>

                                        <!-- Ảnh -->
                                        <div class="mb-3">
                                            <label class="form-label">Ảnh sản phẩm</label>
                                            <input type="file" name="image" class="form-control">
                                            <small class="text-muted">Để trống nếu không muốn đổi ảnh</small>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                            <a href="products.php" class="btn btn-secondary">Hủy</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hiển thị ảnh -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-3">Ảnh hiện tại</h5>
                                    <?php if (!empty($product['image'])): ?>
                                        <img src="../products/<?= $product['image'] ?>" class="img-fluid rounded" width="250">
                                    <?php else: ?>
                                        <p class="text-muted">Không có ảnh</p>
                                    <?php endif; ?>
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