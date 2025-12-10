<?php
session_start();
include('config/config.php');

function getCart()
{
    return isset($_COOKIE['unibook_cart']) ? json_decode($_COOKIE['unibook_cart'], true) : [];
}
$cart = getCart();

function getCartTotal()
{
    global $cart;
    $total = $items = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
        $items += $item['quantity'];
    }
    return ['total' => $total, 'items' => $items];
}
$cartStats = getCartTotal();

$err = '';

// --- Xử lý đặt hàng ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        $err = "Vui lòng đăng nhập để đặt hàng!";
    } elseif (empty($cart)) {
        $err = "Giỏ hàng trống!";
    } else {
        $recipient = trim($_POST['recipient'] ?? '');
        $phone     = trim($_POST['phone'] ?? '');
        $address   = trim($_POST['address'] ?? '');
        $note      = trim($_POST['note'] ?? '');
        $payment   = $_POST['payment_method'] ?? 'cod';

        if (empty($recipient)) $err = "Vui lòng nhập họ tên người nhận";
        elseif (empty($phone)) $err = "Vui lòng nhập số điện thoại";
        elseif (!preg_match('/^0[0-9]{9,10}$/', $phone)) $err = "Số điện thoại không hợp lệ";
        elseif (empty($address)) $err = "Vui lòng nhập địa chỉ giao hàng";
        else {
            try {
                $pdo->beginTransaction();

                $sql = "INSERT INTO orders (user_id, total_price, recipient, phone, address, note, status, payment_method, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, 'pending', ?, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION['user_id'], $cartStats['total'], $recipient, $phone, $address, $note, $payment]);

                $order_id = $pdo->lastInsertId();

                $sqlDetail = "INSERT INTO order_detail (order_id, product_id, quantity, price, total) VALUES (?, ?, ?, ?, ?)";
                $stmtDetail = $pdo->prepare($sqlDetail);
                
                foreach ($cart as $item) {
                    $stmtDetail->execute([$order_id, $item['id'], $item['quantity'], $item['price'], $item['price'] * $item['quantity']]);
                }

                $pdo->commit();
                setcookie('unibook_cart', '', time() - 3600, '/');
                header("Location: order-success.php?order_id=$order_id");
                exit;
            } catch (Exception $e) {
                $pdo->rollBack();
                $err = "Đặt hàng thất bại, vui lòng thử lại!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán - UniBook</title>
    <?php include('include/lib.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container my-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                <li class="breadcrumb-item active">Thanh toán</li>
            </ol>
        </nav>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="alert alert-warning text-center py-5">
                <h4>Bạn chưa đăng nhập</h4>
                <p>Vui lòng đăng nhập để tiếp tục đặt hàng.</p>
                <a href="login.php" class="btn btn-primary btn-lg">Đăng nhập ngay</a>
            </div>
        <?php else: ?>

            <h3 class="mb-4 fw-bold">Xác nhận đơn hàng</h3>

            <?php if ($err): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= htmlspecialchars($err) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="checkout.php">
                <div class="row g-4">
                    <!-- Cột trái: Form thông tin -->
                    <div class="col-lg-8">

                        <!-- Địa chỉ giao hàng -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4 text-danger">
                                    <i class="bi bi-geo-alt-fill me-2"></i>Địa chỉ nhận hàng
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" name="recipient" class="form-control" required
                                            value="<?= htmlspecialchars($_POST['recipient'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" required placeholder="0901234567"
                                            value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-medium">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control" required
                                            placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                            value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-medium">Ghi chú (không bắt buộc)</label>
                                        <textarea name="note" rows="3" class="form-control"
                                            placeholder="Ví dụ: Giao trong giờ hành chính, để trước cửa..."><?= htmlspecialchars($_POST['note'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-credit-card me-2"></i>Phương thức thanh toán
                                </h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                    <label class="form-check-label fs-5" for="cod">
                                        Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank_transfer">
                                    <label class="form-check-label fs-5" for="bank">
                                        Chuyển khoản ngân hàng
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cột phải: Tóm tắt đơn hàng (sticky trên mobile) -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm position-sticky" style="top: 100px;">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">Tóm tắt đơn hàng (<?= $cartStats['items'] ?> sản phẩm)</h5>

                                <div style="max-height: 350px; overflow-y: auto;" class="mb-4">
                                    <?php foreach ($cart as $item): ?>
                                        <div class="d-flex mb-3 pb-3 border-bottom">
                                            <img src="products/<?= htmlspecialchars($item['image']) ?>"
                                                class="rounded me-3 object-fit-contain" width="50">
                                            <div class="flex-grow-1">
                                                <div class="fw-medium"><?= htmlspecialchars($item['title']) ?></div>
                                                <div class="small "><?= htmlspecialchars(number_format($item['price'], 0, ',', '.')) ?> đ</div>
                                                <small class="text-muted">x<?= $item['quantity'] ?></small>
                                            </div>
                                            <div class="text-danger fw-bold text-end">
                                                <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tạm tính</span>
                                        <strong><?= number_format($cartStats['total'], 0, ',', '.') ?>đ</strong>
                                    </div>
                                    <div class="d-flex justify-content-between text-success mb-3">
                                        <span>Phí vận chuyển</span>
                                        <strong>Miễn phí</strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center fs-4">
                                        <span class="fw-bold">Tổng cộng</span>
                                        <span class="text-danger fw-bold"><?= number_format($cartStats['total'], 0, ',', '.') ?>đ</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 fw-bold py-3">
                                    HOÀN TẤT ĐẶT HÀNG
                                </button>

                                <small class="text-muted d-block text-center mt-3">
                                    Bằng việc đặt hàng, bạn đã đồng ý với <a href="#" class="text-decoration-underline">điều khoản mua hàng</a> của UniBook.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>

    <!-- Bootstrap 5 JS -->
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>