<?php
include('config/config.php');
$err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $username = $_POST['username'] ?? '';
   $email = $_POST['email'] ?? '';
   $fullname = $_POST['fullname'] ?? '';
   $password = $_POST['password'] ?? '';
   $password_confirm = $_POST['password_confirm'] ?? '';

   if (empty($username)) {
      $err = "Vui lòng nhập vào tên đăng nhập";
   } elseif (empty($fullname)) {
      $err = "Vui lòng nhập vào họ và tên";
   } elseif (empty($email)) {
      $err = "Vui lòng nhập vào email";
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err = "Email không hợp lệ!";
   } elseif (empty($password)) {
      $err = "Vui lòng nhập vào mật khẩu";
   } elseif ($password !== $password_confirm) {
      $err = "Mật khẩu xác nhận không khớp!";
   }

   if (empty($err)) {
      try {
         $sql = 'SELECT id FROM users WHERE username = ?';
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$username]);
         if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $err = "Tên đăng nhập đã tồn tại";
         }
      } catch (PDOException $e) {
         $err = "Lỗi kiểm tra tài khoản trước khi tạo: " . $e->getMessage();
      }
   }

   if (empty($err)) {
      try {
         $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
         $sql = "INSERT INTO users (username, email, fullname, password ,role ,created_at)
                 VALUES (?, ?, ?, ?, 0,  NOW())";
         $stmt = $pdo->prepare($sql);
         $stmt->execute([$username, $email, $fullname, $hashedPassword]);

         header("Location: login.php?signup=success");
      } catch (PDOException $e) {
         $err = "Lỗi tạo tài khoản: " . $e->getMessage();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Đăng ký tài khoản - Unibook</title>
   <?php include('include/lib.php') ?>
</head>

<body>
   <!-- navigation -->
   <div class="border-bottom shadow-sm">
      <nav class="navbar navbar-light py-2">
         <div class="container justify-content-center justify-content-lg-between">
            <a class="navbar-brand" href="index.php">
               <img src="images/logo/logo-unibook.svg" alt="" class="d-inline-block align-text-top" />
            </a>
            <span class="navbar-text">
               Bạn đã có tài khoản?
               <a href="login.php">Đăng nhập</a>
            </span>
         </div>
      </nav>
   </div>

   <main>
      <!-- section -->

      <section class="my-lg-14 my-8">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
               <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                  <!-- img -->
                  <img src="images/svg-graphics/signup-g.svg" alt="" class="img-fluid" />
               </div>
               <!-- col -->
               <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                  <div class="mb-lg-9 mb-5">
                     <h1 class="mb-1 h2 fw-bold">Tạo tài khoản</h1>
                     <p>Chào mừng đến với UniBook! Hãy tạo tài khoản để bắt đầu.</p>
                  </div>
                  <?php if (!empty($err)): ?>
                     <div class="alert alert-danger"><?= $err ?></div>
                  <?php endif; ?>

                  <!-- form -->
                  <form action="signup.php" method="POST" class="needs-validation" novalidate>
                     <div class="row g-3">
                        <div class="col-12">
                           <!-- input -->
                           <label for="formSignupEmail" class="form-label">Email</label>
                           <input type="email" class="form-control" id="formSignupEmail" placeholder="Email" required name="email" />
                           <div class="invalid-feedback">Hãy nhập vào email</div>
                        </div>
                        <div class="col-12">
                           <!-- input -->
                           <label for="username" class="form-label">Tên đăng nhập</label>
                           <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập" required name="username" />
                           <div class="invalid-feedback">Hãy nhập vào tên đăng nhập</div>
                        </div>
                        <div class="col-12">
                           <!-- input -->
                           <label for="fullname" class="form-label">Họ và tên</label>
                           <input type="text" class="form-control" id="fullname" placeholder="Họ và tên" required name="fullname" />
                           <div class="invalid-feedback">Hãy nhập vào họ và tên</div>
                        </div>
                        <div class="col-12">
                           <div class="password-field position-relative">
                              <label for="password" class="form-label">Mật khẩu</label>
                              <div class="password-field position-relative">
                                 <input type="password" class="form-control fakePassword" id="password" placeholder="*****" required name="password" />
                                 <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                 <div class="invalid-feedback">Hãy nhập vào mật khẩu.</div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="password-field position-relative">
                              <label for="password_confirm" class="form-label">Nhập lại mật khẩu</label>
                              <div class="password-field position-relative">
                                 <input type="password" class="form-control fakePassword" id="password_confirm" placeholder="*****" required name="password_confirm" />
                                 <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                 <div class="invalid-feedback">Hãy nhập vào mật khẩu.</div>
                              </div>
                           </div>
                        </div>

                        <!-- btn -->
                        <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Đăng ký</button></div>

                        <!-- text -->
                        <p>
                           <small>
                              Bằng việc đăng ký, bạn đồng ý với
                              <a href="#!">Chính sách</a>
                              &
                              <a href="#!">Điều khoản</a>
                           </small>
                        </p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </main>

   <!-- Footer -->
   <!-- footer -->
   <?php include('footer.php') ?>
   <!-- Javascript-->
   <!-- Libs JS -->
   <!-- <script src="libs/jquery/dist/jquery.min.js"></script> -->
   <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="libs/simplebar/dist/simplebar.min.js"></script>

   <!-- Theme JS -->
   <script src="js/theme.min.js"></script>

   <script src="js/vendors/password.js"></script>

   <script src="js/vendors/validation.js"></script>
</body>

<!-- Mirrored from freshcart.codescandy.com/pages/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:47 GMT -->

</html>