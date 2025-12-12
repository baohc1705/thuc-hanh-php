<?php
include('config/config.php');

session_start();

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $err = "Vui lòng nhập tên đăng nhập!";
    } elseif (empty($password)) {
        $err = "Vui lòng nhập mật khẩu!";
    }

    if (empty($err)) {
        try {
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $err = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            } elseif (!password_verify($password, $user['password'])) {
                $err = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            } elseif ($user['status'] == 0) {
                $err = "Tài khoản của bạn đã bị vô hiệu hóa!";
            } else {
                // Đăng nhập thành công
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];


                header("Location: index.php?login=success");

                exit;
            }
        } catch (PDOException $e) {
            $err = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Đăng nhập - UniBook</title>
    <?php include('include/lib.php') ?>
</head>

<body>
    <!-- navigation -->
    <div class="border-bottom shadow-sm">
        <nav class="navbar navbar-light py-2">
            <div class="container justify-content-center justify-content-lg-between">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo/logo-unibook.svg" alt="UniBook" class="d-inline-block align-text-top" />
                </a>
                <span class="navbar-text">
                    Bạn chưa có tài khoản?
                    <a href="signup.php">Đăng ký</a>
                </span>
            </div>
        </nav>
    </div>

    <main>
        <!-- section -->
        <section class="my-lg-14 my-8">
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="images/svg-graphics/signin-g.svg" alt="Đăng nhập" class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Đăng nhập vào UniBook</h1>
                            <p>Chào mừng quay lại với UniBook!</p>
                        </div>

                        <?php if (isset($_GET['signup']) && $_GET['signup'] === 'success'): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Tạo tài khoản thành công. Vui lòng đăng nhập!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($err)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($err) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="login.php" class="needs-validation" novalidate>
                            <div class="row g-3">

                                <!-- Username -->
                                <div class="col-12">
                                    <label for="username" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        placeholder="Nhập tên đăng nhập"
                                        required />
                                    <div class="invalid-feedback">Hãy nhập vào tên đăng nhập.</div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                    <div class="password-field position-relative">
                                        <input
                                            type="password"
                                            class="form-control fakePassword"
                                            id="password"
                                            name="password"
                                            placeholder="*****"
                                            required />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                        <div class="invalid-feedback">Hãy nhập vào mật khẩu.</div>
                                    </div>
                                </div>

                                <!-- Remember & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                        <label class="form-check-label" for="remember">
                                            Nhớ tôi
                                        </label>
                                    </div>
                                    <div>
                                        <a href="forgot-password.php" class="text-decoration-none">Quên mật khẩu?</a>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
                                </div>

                                <!-- Sign Up Link -->
                                <div class="col-12 text-center">
                                    Bạn chưa có tài khoản?
                                    <a href="signup.php" class="text-decoration-none fw-semibold">Đăng ký ngay</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('footer.php') ?>

    <!-- Javascript-->
    <!-- Libs JS -->
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="js/theme.min.js"></script>

    <script src="js/vendors/password.js"></script>
    <script src="js/vendors/validation.js"></script>
</body>

</html>