<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$err = "";
$success = "";

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $name = $_POST['name'] ?? '';

   $description = $_POST['description'] ?? '';
   $status = $_POST['status'] ?? 1;

   // Xử lý upload ảnh
   $image = "";
   if (!empty($_FILES['image']['name'])) {

      $fileName = time() . "_" . $_FILES['image']['name'];
      $targetPath = "../images/category/" . $fileName;

      // Tạo thư mục nếu chưa có
      if (!file_exists("../images/category")) {
         mkdir("../images/category", 0777, true);
      }

      if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
         $image = $fileName;
      } else {
         $err = "Upload ảnh thất bại!";
      }
   }

   if ($err === "") {
      try {
         $sql = "INSERT INTO category (name, image , description, status) 
                    VALUES (?, ?, ?, ?)";

         $stmt = $pdo->prepare($sql);
         $stmt->execute([$name, $image, $description, $status]);

         header("Location: categories.php?add=success");
         exit;
      } catch (PDOException $e) {
         $err = "Lỗi thêm dữ liệu: " . $e->getMessage();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Thêm danh mục mới</title>
   <?php include('include/lib.php') ?>
</head>

<body>
   <?php include('header.php') ?>
   <div class="main-wrapper">
      <?php include('sidebar.php') ?>

      <main class="main-content-wrapper">
         <div class="container">

            <h2>Thêm danh mục mới</h2>

            <?php if (!empty($err)): ?>
               <div class="alert alert-danger"><?= $err ?></div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">

               <!-- Hình ảnh -->
               <div class="mb-3">
                  <label class="form-label">Ảnh danh mục</label>
                  <input type="file" name="image" class="form-control" />
               </div>

               <!-- Tên -->
               <div class="mb-3">
                  <label class="form-label">Tên danh mục</label>
                  <input type="text" name="name" class="form-control" required>
               </div>

               <!-- Mô tả -->
               <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"></textarea>
               </div>

               <!-- Trạng thái -->
               <div class="mb-3">
                  <label class="form-label">Status</label><br>
                  <input type="radio" name="status" value="1" checked> Hoạt động
                  <input type="radio" name="status" value="0"> Không hoạt động
               </div>

               <button class="btn btn-primary" type="submit">Tạo mới</button>
               <a href="categories.php" class="btn btn-secondary">Quay lại</a>

            </form>
         </div>
      </main>
   </div>
</body>

</html>