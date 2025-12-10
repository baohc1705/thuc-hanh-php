<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

// -------------------- LOAD CATEGORY --------------------
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? 0;
    try {
        $sql = "SELECT * FROM category WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$category) {
            die("Category không tồn tại!");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// -------------------- UPDATE CATEGORY --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Giữ ảnh cũ
    $currentImage = $_POST['current_image'];

    $newImageName = $currentImage;

    // Nếu có upload ảnh mới
    if (!empty($_FILES['image']['name'])) {

        $fileName = time() . "_" . $_FILES['image']['name'];
        $targetPath = "../images/category/" . $fileName;

        // Tạo folder nếu chưa có
        if (!file_exists("../images/category")) {
            mkdir("../images/category", 0777, true);
        }

        // Upload thành công
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $newImageName = $fileName;

            // Xóa ảnh cũ nếu tồn tại
            if (!empty($currentImage) && file_exists("../images/category/" . $currentImage)) {
                unlink("../images/category/" . $currentImage);
            }
        }
    }

    // Update DB
    try {
        $sql = "UPDATE category 
                SET name = ?, image = ?, description = ?, status = ?
                WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $newImageName, $description, $status, $id]);

        header("Location: categories.php?update=success");
        exit;

    } catch (PDOException $e) {
        echo "Lỗi cập nhật: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Chỉnh sửa danh mục</title>
    <link rel="stylesheet" href="../css/theme.min.css" />
</head>

<body>
    <?php include('header.php') ?>
    <div class="main-wrapper">
        <?php include('sidebar.php') ?>

        <main class="main-content-wrapper">
            <div class="container">
                <h2>Chỉnh sửa danh mục</h2>

                <div class="row">
                    <div class="col-md-6">

                        <form action="edit-category.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                            <input type="hidden" name="current_image" value="<?= $category['image'] ?>">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" value="<?= $category['name'] ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" required><?= $category['description'] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                    <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                            <a href="categories.php" class="btn btn-secondary">Hủy</a>

                        </form>
                    </div>

                    <!-- Hiển thị ảnh -->
                    <div class="col-md-6 text-center">
                        <?php if (!empty($category['image'])): ?>
                            <img src="../images/category/<?= $category['image'] ?>" class="img-fluid rounded" width="300">
                        <?php else: ?>
                            <p>Không có ảnh</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
