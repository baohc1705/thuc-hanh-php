<?php
session_start();
include('config/config.php');
include('config/vnpay_config.php');
$vnp_Config = include 'config/vnpay_config.php';

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
                // Tạo mã đơn hàng dạng chuỗi thời gian + 4 số random
                $order_id = date('YmdHis') . rand(1000, 9999);
                $date_now = date('Y-m-d H:i:s');

                if ($payment === 'cod') {
                    // Lưu đơn COD ngay vào DB
                    $pdo->beginTransaction();

                    $status = 'pending';
                    $payment_status = 'unpaid';
                    $sql = "INSERT INTO orders 
                            (id, user_id, total_price, recipient, phone, address, note, 
                             status, payment_status, payment_method, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        $order_id,
                        $_SESSION['user_id'],
                        $cartStats['total'],
                        $recipient,
                        $phone,
                        $address,
                        $note,
                        $status,
                        $payment_status,
                        $payment,
                        $date_now
                    ]);

                    // Insert chi tiết đơn hàng
                    $sqlDetail = "INSERT INTO order_detail (order_id, product_id, quantity, price, total) 
                                  VALUES (?, ?, ?, ?, ?)";
                    $stmtDetail = $pdo->prepare($sqlDetail);
                    foreach ($cart as $item) {
                        $stmtDetail->execute([
                            $order_id,
                            $item['id'],
                            $item['quantity'],
                            $item['price'],
                            $item['price'] * $item['quantity']
                        ]);
                    }

                    $pdo->commit();

                    // Xóa giỏ và chuyển sang trang thành công
                    setcookie('unibook_cart', '', time() - 3600, '/');
                    header("Location: order-success.php?order_id=$order_id");
                    exit;
                } else {
                    // VNPAY: chưa lưu DB, chỉ lưu tạm vào session
                    $_SESSION['pending_vnpay_order'] = [
                        'order_id'       => $order_id,
                        'user_id'        => $_SESSION['user_id'],
                        'total_price'    => $cartStats['total'],
                        'recipient'      => $recipient,
                        'phone'          => $phone,
                        'address'        => $address,
                        'note'           => $note,
                        'status'         => 'pending',
                        'payment_status' => 'unpaid',
                        'payment_method' => 'vnpay',
                        'created_at'     => $date_now,
                        'cart_items'     => $cart,
                    ];

                    // Tạo URL thanh toán VNPAY
                    $vnp_TxnRef = $order_id;
                    $vnp_OrderInfo = "Thanh toán đơn hàng UniBook #$order_id";
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = $cartStats['total'] * 100; // VNPAY tính theo đồng
                    $vnp_Locale = 'vn';
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    $vnp_ReturnUrl = $vnp_Config['vnp_ReturnUrl'];

                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_Config['vnp_TmnCode'],
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_ReturnUrl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                    );

                    ksort($inputData);
                    $hashdata = "";
                    $i = 0;
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                    }

                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_Config['vnp_HashSecret']);
                    $vnp_Url = $vnp_Config['vnp_Url'] . "?" . http_build_query($inputData) . '&vnp_SecureHash=' . $vnpSecureHash;

                    // Chuyển hướng sang VNPAY
                    header('Location: ' . $vnp_Url);
                    exit;
                }
            } catch (Exception $e) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
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
                                    <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay">
                                    <label class="form-check-label fs-5" for="vnpay">
                                        <img src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.jpg" width="20" class="me-2">
                                        Thanh toán qua VNPAY (Thẻ ATM / QR / Ví)
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