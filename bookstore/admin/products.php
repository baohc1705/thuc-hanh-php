<?php
include('../config/config.php');

$products = [];

try {
   $sql = "SELECT p.*, c.name as category_name
              FROM product p
              LEFT JOIN category c on p.category_id = c.id
              ORDER BY p.createAt";

   $stmt = $pdo->query($sql);

   $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Quản lý sản phẩm - Unibook</title>
   <?php include('include/lib.php') ?>
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
               <div class="row mb-8">
                  <div class="col-md-12">
                     <!-- page header -->
                     <div class="d-md-flex justify-content-between align-items-center">
                        <h2>Danh sách sản phẩm</h2>
                        <!-- button -->
                        <div>
                           <a href="add-product.php" class="btn btn-primary">Thêm sản phẩm mới</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <div class="row">
                  <div class="col-xl-12 col-12 mb-5">
                     <!-- card -->
                     <div class="card h-100 card-lg">
                        <div class="px-6 py-6">
                           <div class="row justify-content-between">
                              <!-- form -->
                              <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                                 <form class="d-flex" role="search">
                                    <input class="form-control" type="search" placeholder="Search Products" aria-label="Search" />
                                 </form>
                              </div>
                              <!-- select option -->
                              <div class="col-lg-2 col-md-4 col-12">
                                 <select class="form-select">
                                    <option selected>Trạng thái</option>
                                    <option value="1">Đang kinh doanh</option>
                                    <option value="2">Không kinh doanh</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <!-- card body -->
                        <div class="card-body p-0">
                           <?php
                           if (isset($_GET['add']) && $_GET['add'] === 'success') {
                           ?>
                              <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                 <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Đã thêm sản phẩm thành công!</span>
                                 </div>
                                 <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                              </div>
                           <?php
                           }
                           ?>
                           <?php
                           if (isset($_GET['delete']) && $_GET['delete'] === 'success') {
                           ?>
                              <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                 <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Đã xóa sản phẩm thành công!</span>
                                 </div>
                                 <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                              </div>
                           <?php
                           }
                           ?>
                           <?php
                           if (isset($_GET['update']) && $_GET['update'] === 'success') {
                           ?>
                              <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                 <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Đã sửa sản phẩm thành công!</span>
                                 </div>
                                 <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                              </div>
                           <?php
                           }
                           ?>
                           <!-- table -->
                           <div class="table-responsive">
                              <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                                 <thead class="bg-light">
                                    <tr>
                                       <th>STT</th>
                                       <th>Ảnh</th>
                                       <th>Tiêu đề</th>
                                       <th>Danh mục</th>
                                       <th>Trạng thái</th>
                                       <th>Giá</th>
                                       <th>Số lượng</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $stt = 0;
                                    foreach ($products as $p) {
                                       $stt++;

                                    ?>
                                       <tr>
                                          <td><?= $stt ?></td>
                                          <td>
                                             <img src="../products/<?= $p['image'] ?>" alt="" class="object-fit-contain" width="50" />
                                          </td>
                                          <td><?= $p['title'] ?></td>
                                          <td><?= $p['category_name'] ?></td>

                                          <td>
                                             <span class="<?= $p['status'] ? 'badge bg-light-primary text-dark-primary' : 'badge bg-light-danger text-dark-danger' ?>"><?= $p['status'] ? 'Hoạt động' : 'Không hoạt động' ?></span>
                                          </td>
                                          <td><?= $p['price'] ?></td>
                                          <td><?= $p['stock'] ?></td>
                                          <td>
                                             <a href="./delete-product.php?id=<?= $p['id'] ?>" class="btn btn-danger">Xóa</a>
                                             <a href="./edit-product.php?id=<?= $p['id'] ?>" class="btn btn-warning">Sửa</a>
                                          </td>
                                       </tr>
                                    <?php
                                    }
                                    ?>

                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
   </div>

   <!-- Libs JS -->
   <!-- <script src="../libs/jquery/dist/jquery.min.js"></script> -->
   <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../libs/simplebar/dist/simplebar.min.js"></script>

   <!-- Theme JS -->
   <script src="../js/theme.min.js"></script>

   <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
   <script src="../js/vendors/chart.js"></script>
</body>

<!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:53 GMT -->

</html>