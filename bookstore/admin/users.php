<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$users = [];

try {
  $sql = "SELECT * FROM users ORDER BY created_at DESC";

  $stmt = $pdo->query($sql);

  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Quản lý người dùng - Unibook</title>
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
          <div class="row mb-8">
            <div class="col-md-12">
              <!-- page header -->
              <div class="d-md-flex justify-content-between align-items-center">
                <h2>Danh sách người dùng</h2>
                <!-- button -->
                <div>
                  <a href="add-user.php" class="btn btn-primary">Thêm người dùng mới</a>
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
                        <input class="form-control" type="search" placeholder="Tìm kiếm người dùng" aria-label="Search" />
                      </form>
                    </div>
                    <!-- select option -->
                    <div class="col-lg-2 col-md-4 col-12">
                      <select class="form-select">
                        <option selected>Quyền</option>
                        <option value="0">Khách hàng</option>
                        <option value="1">Quản trị viên</option>
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
                        <span>Đã thêm người dùng thành công!</span>
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
                        <span>Đã xóa người dùng thành công!</span>
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
                        <span>Đã sửa người dùng thành công!</span>
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
                          <th>Tên đăng nhập</th>
                          <th>Họ tên</th>
                          <th>Email</th>
                          <th>Số điện thoại</th>
                          <th>Quyền</th>
                          <th>Trạng thái</th>
                          <th>Ngày tạo</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $stt = 0;
                        foreach ($users as $u) {
                          $stt++;
                        ?>
                          <tr>
                            <td><?= $stt ?></td>
                            <td><?= $u['username'] ?></td>
                            <td><?= $u['fullname'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['phone'] ?: '-' ?></td>
                            <td>
                              <span class="<?= $u['role'] ? 'badge bg-light-danger text-dark-danger' : 'badge bg-light-primary text-dark-primary' ?>">
                                <?= $u['role'] ? 'Quản trị viên' : 'Khách hàng' ?>
                              </span>
                            </td>
                            <td>
                              <span class="<?= $u['status'] ? 'badge bg-light-success text-dark-success' : 'badge bg-light-warning text-dark-warning' ?>">
                                <?= $u['status'] ? 'Hoạt động' : 'Vô hiệu hóa' ?>
                              </span>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($u['created_at'])) ?></td>
                            <td>
                              <a href="./delete-user.php?id=<?= $u['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                              <a href="./edit-user.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
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
  <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../js/theme.min.js"></script>
  <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../js/vendors/chart.js"></script>
</body>

<!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:53 GMT -->

</html>