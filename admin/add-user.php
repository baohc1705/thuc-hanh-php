<?php
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

$err = "";
$success = "";

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $username = $_POST['username'] ?? '';
   $password = $_POST['password'] ?? '';
   $password_confirm = $_POST['password_confirm'] ?? '';
   $fullname = $_POST['fullname'] ?? '';
   $email = $_POST['email'] ?? '';
   $phone = $_POST['phone'] ?? '';
   $address = $_POST['address'] ?? '';
   $role = $_POST['role'] ?? 0;
   $status = $_POST['status'] ?? 1;

   // Validate dữ liệu
   if (empty($username)) {
      $err = "Vui lòng nhập tên đăng nhập!";
   } elseif (empty($password)) {
      $err = "Vui lòng nhập mật khẩu!";
   } elseif ($password !== $password_confirm) {
      $err = "Mật khẩu xác nhận không khớp!";
   } elseif (empty($fullname)) {
      $err = "Vui lòng nhập họ tên!";
   } elseif (empty($email)) {
      $err = "Vui lòng nhập email!";
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err = "Email không hợp lệ!";
   }

   // Kiểm tra username đã tồn tại
   if (empty($err)) {
      try {
         $sql = "SELECT id FROM users WHERE username = ?";
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$username]);
         if ($stmt->fetch()) {
            $err = "Tên đăng nhập đã tồn tại!";
         }
      } catch (PDOException $e) {
         $err = "Lỗi kiểm tra tên đăng nhập: " . $e->getMessage();
      }
   }

   // Insert vào database
   if (empty($err)) {
      try {
         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
         
         $sql = "INSERT INTO users (username, password, fullname, email, phone, address, role, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->execute([$username, $hashedPassword, $fullname, $email, $phone, $address, $role, $status]);

         header("Location: users.php?add=success");
         exit;
      } catch (PDOException $e) {
         $err = "Lỗi thêm người dùng: " . $e->getMessage();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
   <title>Thêm người dùng mới - Unibook</title>
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
                     <div>
                        <h2>Thêm người dùng mới</h2>
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item"><a href="users.php" class="text-inherit">Quản lý người dùng</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-8">
                     <div class="card shadow border-0">
                        <div class="card-body d-flex flex-column gap-8 p-7">

                           <?php if (!empty($err)): ?>
                              <div class="alert alert-danger"><?= $err ?></div>
                           <?php endif; ?>

                           <div class="d-flex flex-column gap-4">
                              <h3 class="mb-0 h6">Thông tin người dùng</h3>

                              <form class="row g-3" method="POST" action="add-user.php" enctype="multipart/form-data">

                                 <!-- Tên đăng nhập -->
                                 <div class="col-lg-6 col-12">
                                    <label for="username" class="form-label">
                                       Tên đăng nhập
                                       <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" required />
                                 </div>

                                 <!-- Họ tên -->
                                 <div class="col-lg-6 col-12">
                                    <label for="fullname" class="form-label">
                                       Họ tên
                                       <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ và tên" required />
                                 </div>

                                 <!-- Email -->
                                 <div class="col-lg-6 col-12">
                                    <label for="email" class="form-label">
                                       Email
                                       <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                                 </div>

                                 <!-- Số điện thoại -->
                                 <div class="col-lg-6 col-12">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" />
                                 </div>

                                 <!-- Địa chỉ -->
                                 <div class="col-12">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" />
                                 </div>

                                 <!-- Mật khẩu -->
                                 <div class="col-lg-6 col-12">
                                    <label for="password" class="form-label">
                                       Mật khẩu
                                       <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required />
                                 </div>

                                 <!-- Xác nhận mật khẩu -->
                                 <div class="col-lg-6 col-12">
                                    <label for="password_confirm" class="form-label">
                                       Xác nhận mật khẩu
                                       <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu" required />
                                 </div>

                                 <!-- Quyền -->
                                 <div class="col-lg-6 col-12">
                                    <label for="role" class="form-label">Quyền</label>
                                    <select class="form-select" id="role" name="role">
                                       <option value="0">Khách hàng</option>
                                       <option value="1">Quản trị viên</option>
                                    </select>
                                 </div>

                                 <!-- Trạng thái -->
                                 <div class="col-lg-6 col-12">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="status" name="status">
                                       <option value="1">Hoạt động</option>
                                       <option value="0">Vô hiệu hóa</option>
                                    </select>
                                 </div>

                                 <!-- Buttons -->
                                 <div class="col-12 mt-3">
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                       <button class="btn btn-primary" type="submit">Thêm người dùng</button>
                                       <a href="users.php" class="btn btn-secondary">Hủy</a>
                                    </div>
                                 </div>

                              </form>

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

</html>