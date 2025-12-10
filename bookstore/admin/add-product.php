<?php
include('../config/config.php');

$err = "";
$success = "";
$categories = [];

// Lấy danh sách danh mục
try {
   $sql = "SELECT id, name FROM category WHERE status = 1 ORDER BY name";
   $stmt = $pdo->query($sql);
   $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   $err = "Lỗi lấy danh mục: " . $e->getMessage();
}

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $title = $_POST['title'] ?? '';
   $description = $_POST['description'] ?? '';
   $author = $_POST['author'] ?? '';
   $price = $_POST['price'] ?? 0;
   $category_id = $_POST['category_id'] ?? null;
   $stock = $_POST['stock'] ?? 0;
   $status = $_POST['status'] ?? 1;

   // Xử lý upload ảnh
   $image = "";
   if (!empty($_FILES['image']['name'])) {

      $fileName = time() . "_" . $_FILES['image']['name'];
      $targetPath = "../products/" . $fileName;

      // Tạo thư mục nếu chưa có
      if (!file_exists("../products")) {
         mkdir("../products", 0777, true);
      }

      if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
         $image = $fileName;
      } else {
         $err = "Upload ảnh thất bại!";
      }
   }

   if (empty($title)) {
      $err = "Vui lòng nhập tên sản phẩm!";
   } elseif (empty($price) || $price <= 0) {
      $err = "Vui lòng nhập giá sản phẩm hợp lệ!";
   } elseif (empty($category_id)) {
      $err = "Vui lòng chọn danh mục!";
   } elseif (empty($stock) || $stock <= 0) {
      $err = "Vui lòng nhập số lượng hợp lệ!";
   } elseif (empty($author)) {
      $err = "Vui lòng nhập vào tên tác giả!";
   }

   if ($err === "") {
      try {
         $sql = "INSERT INTO product (title, description, price, image, category_id, stock, status, author, createAt) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->execute([$title, $description, $price, $image, $category_id, $stock, $status, $author]);

         header("Location: products.php?add=success");
         exit;
      } catch (PDOException $e) {
         $err = "Lỗi thêm sản phẩm: " . $e->getMessage();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

   <title>Thêm sản phẩm mới - Unibook</title>
   <?php include("include/lib.php") ?>
</head>

<body>
   <!-- main -->
   <div>
      <!-- navbar -->
      <?php include('header.php') ?>

      <div class="main-wrapper">

         <?php include('sidebar.php') ?>

         <!-- main wrapper -->
         <main class="main-content-wrapper">
            <div class="container">

               <h2 class="mb-5">Thêm sản phẩm mới</h2>

               <?php if (!empty($err)): ?>
                  <div class="alert alert-danger"><?= $err ?></div>
               <?php endif; ?>
               <form action="add-product.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="card">
                           <div class="card-body">
                              <!-- Hình ảnh -->
                              <div class="mb-3">
                                 <label class="form-label">Ảnh sản phẩm</label>
                                 <input type="file" name="image" class="form-control" accept="image/*" />
                              </div>

                              <!-- Tên sản phẩm -->
                              <div class="mb-3">
                                 <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                 <input type="text" name="title" class="form-control" required />
                              </div>

                              <!-- Mô tả -->
                              <div class="mb-3">
                                 <label class="form-label">Mô tả</label>
                                 <textarea name="description" class="form-control" rows="4"></textarea>
                              </div>



                              <!-- Danh mục -->
                              <div class="mb-3">
                                 <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                 <select name="category_id" class="form-control" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php foreach ($categories as $cat): ?>
                                       <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>

                              <!-- Tác giả -->
                              <div class="mb-3">
                                 <label class="form-label">Tác giả <span class="text-danger">*</span></label>
                                 <input type="text" name="author" class="form-control" required />
                              </div>


                              <button class="btn btn-primary" type="submit">Thêm sản phẩm</button>
                              <a href="products.php" class="btn btn-secondary">Quay lại</a>

                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card">
                           <div class="card-body">
                              <!-- Trạng thái -->
                              <div class="mb-3">
                                 <label class="form-label" id="productSKU">Trạng thái</label>
                                 <br />
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked />
                                    <label class="form-check-label" for="inlineRadio1">Kinh doanh</label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" />
                                    <label class="form-check-label" for="inlineRadio2">Không kinh doanh</label>
                                 </div>
                              </div>

                              <!-- Giá -->
                              <div class="mb-3">
                                 <label class="form-label">Giá <span class="text-danger">*</span></label>
                                 <input type="number" name="price" class="form-control" step="0.01" min="0" required />
                              </div>

                              <!-- số lượng -->
                              <div class="mb-3">
                                 <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                                 <input type="number" name="stock" class="form-control" step="1" min="0" required />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </main>
      </div>
   </div>

   <!-- Libs JS -->
   <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../libs/simplebar/dist/simplebar.min.js"></script>
   <script src="../js/theme.min.js"></script>
   <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
   <script src="../js/vendors/chart.js"></script>
</body>

</html>