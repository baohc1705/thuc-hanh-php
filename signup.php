<?php
include('config/config.php');

$err = "";
$old = []; // Lưu lại dữ liệu hợp lệ để hiển thị lại sau lỗi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy và làm sạch dữ liệu đầu vào
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Lưu lại dữ liệu hợp lệ để repopulate form
    $old = [
        'username' => $username,
        'email'    => $email,
        'fullname' => $fullname
    ];

    // === Validation chi tiết ===
    if (empty($username)) {
        $err = "Vui lòng nhập tên đăng nhập.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,30}$/', $username)) {
        $err = "Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới (_), độ dài 4-30 ký tự.";
    } elseif (empty($fullname)) {
        $err = "Vui lòng nhập họ và tên.";
    } elseif (mb_strlen($fullname, 'UTF-8') < 2 || mb_strlen($fullname, 'UTF-8') > 50) {
        $err = "Họ và tên phải từ 2 đến 50 ký tự.";
    } elseif (empty($email)) {
        $err = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Định dạng email không hợp lệ.";
    } elseif (empty($password)) {
        $err = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 8) {
        $err = "Mật khẩu phải có ít nhất 8 ký tự.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $err = "Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số.";
    } elseif ($password !== $password_confirm) {
        $err = "Mật khẩu xác nhận không khớp.";
    }

    // Kiểm tra username và email đã tồn tại chưa
    if (empty($err)) {
        try {
            $sql = "SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':username' => $username, ':email' => $email]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing) {
                if ($existing['username'] === $username) { // Giả sử có thể lấy được username từ row
                    $err = "Tên đăng nhập đã được sử dụng.";
                } else {
                    $err = "Email này đã được đăng ký.";
                }
            }
        } catch (PDOException $e) {
            $err = "Lỗi hệ thống, vui lòng thử lại sau.";
            error_log("Signup check existence error: " . $e->getMessage());
        }
    }

    // Đăng ký nếu không có lỗi
    if (empty($err)) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, email, fullname, password, role, status, created_at)
                    VALUES (:username, :email, :fullname, :password, 0, 1, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':email'    => $email,
                ':fullname' => $fullname,
                ':password' => $hashedPassword
            ]);

            header("Location: login.php?signup=success");
            exit;
        } catch (PDOException $e) {
            $err = "Không thể tạo tài khoản, vui lòng thử lại sau.";
            error_log("Signup insert error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng ký tài khoản - UniBook</title>
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
                    Bạn đã có tài khoản?
                    <a href="login.php">Đăng nhập</a>
                </span>
            </div>
        </nav>
    </div>

    <main>
        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <img src="images/svg-graphics/signup-g.svg" alt="Đăng ký" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Tạo tài khoản</h1>
                            <p>Chào mừng đến với UniBook! Hãy tạo tài khoản để bắt đầu.</p>
                        </div>

                        <?php if (!empty($err)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="signup.php" method="POST" class="needs-validation" novalidate>
                            <div class="row g-3">

                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="nhap@email.com" required
                                           value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES) ?>" />
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
                                </div>

                                <!-- Username -->
                                <div class="col-12">
                                    <label for="username" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" name="username"
                                           placeholder="username123" required pattern="[a-zA-Z0-9_]{4,30}"
                                           value="<?= htmlspecialchars($old['username'] ?? '', ENT_QUOTES) ?>" />
                                    <div class="invalid-feedback">Tên đăng nhập 4-30 ký tự, chỉ chứa chữ, số và _</div>
                                </div>

                                <!-- Fullname -->
                                <div class="col-12">
                                    <label for="fullname" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                           placeholder="Nguyễn Văn A" required
                                           value="<?= htmlspecialchars($old['fullname'] ?? '', ENT_QUOTES) ?>" />
                                    <div class="invalid-feedback">Vui lòng nhập họ và tên.</div>
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                    <div class="password-field position-relative">
                                        <input type="password" class="form-control fakePassword" id="password" name="password"
                                               placeholder="••••••••" required minlength="8" />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                        <div class="invalid-feedback">
                                            Mật khẩu ít nhất 8 ký tự, có chữ hoa, chữ thường và số.
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-12">
                                    <label for="password_confirm" class="form-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                                    <div class="password-field position-relative">
                                        <input type="password" class="form-control fakePassword" id="password_confirm" name="password_confirm"
                                               placeholder="••••••••" required />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                        <div class="invalid-feedback">Mật khẩu không khớp.</div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                                </div>

                                <p class="text-center small">
                                    Bằng việc đăng ký, bạn đồng ý với
                                    <a href="#!">Chính sách</a> &
                                    <a href="#!">Điều khoản</a> của chúng tôi.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('footer.php') ?>

    <!-- Javascript -->
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="libs/simplebar/dist/simplebar.min.js"></script>
    <script src="js/theme.min.js"></script>
    <script src="js/vendors/password.js"></script>
    <script src="js/vendors/validation.js"></script>

    <script>
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    const password = form.querySelector('#password').value
                    const confirm = form.querySelector('#password_confirm').value
                    if (password !== confirm) {
                        form.querySelector('#password_confirm').setCustomValidity('Mật khẩu không khớp')
                    } else {
                        form.querySelector('#password_confirm').setCustomValidity('')
                    }
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>