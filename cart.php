<?php
include('config/config.php');
session_start();

define('CART_COOKIE_NAME', 'unibook_cart');
define('CART_COOKIE_EXPIRE', time() + (30 * 24 * 60 * 60)); // 30 ngày

// Lấy giỏ hàng từ cookie
function getCart()
{
    if (isset($_COOKIE[CART_COOKIE_NAME])) {
        $data = json_decode($_COOKIE[CART_COOKIE_NAME], true);
        return is_array($data) ? $data : [];
    }
    return [];
}

// Lưu giỏ hàng vào cookie
function saveCart($cart)
{
    setcookie(CART_COOKIE_NAME, json_encode($cart), CART_COOKIE_EXPIRE, "/", "", false, true);
}

// Load giỏ hàng
$cart = getCart();

// Hàm thêm sản phẩm
function addToCart($id, $title, $price, $image, $quantity = 1)
{
    global $cart;
    $id = (int)$id;
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        $cart[$id] = [
            'id' => $id,
            'title' => $title,
            'price' => (float)$price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
    saveCart($cart);
}

// Xử lý hành động
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = (int)($_GET['id'] ?? 0);

    switch ($action) {
        case 'add':
            if ($id > 0 && isset($_GET['title'], $_GET['price'], $_GET['image'])) {
                addToCart($id, $_GET['title'], $_GET['price'], $_GET['image']);
            }
            header('Location: cart.php');
            exit;

        case 'remove':
            if ($id > 0 && isset($cart[$id])) {
                unset($cart[$id]);
                saveCart($cart);
            }
            header('Location: cart.php');
            exit;

        case 'update':
            if ($id > 0 && isset($_POST['quantity'])) {
                $qty = max(1, (int)$_POST['quantity']);
                if ($qty >= 1) {
                    $cart[$id]['quantity'] = $qty;
                } else {
                    unset($cart[$id]);
                }
                saveCart($cart);
            }
            header('Location: cart.php');
            exit;

        case 'clear':
            setcookie(CART_COOKIE_NAME, '', time() - 3600, "/");
            header('Location: cart.php');
            exit;
    }
}

// Tính tổng tiền và số lượng sản phẩm
function getCartTotal()
{
    global $cart;
    $total = 0;
    $items = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
        $items += $item['quantity'];
    }
    return ['total' => $total, 'items' => $items];
}

$cartStats = getCartTotal();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng - Unibook</title>
    <?php include('include/lib.php') ?>
</head>

<body>
    <?php include('header.php') ?>

    <main>
        <!-- Breadcrumb -->
        <div class="mt-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="shop.php?cate=all">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="mb-8 mt-8">
            <div class="container">
                <h1 class="fw-bold mb-5">Giỏ hàng của bạn</h1>

                <?php if (empty($cart)): ?>
                    <div class="text-center py-5">
                        <img src="images/svg-graphics/store-graphics.svg" alt="Giỏ hàng trống" width="500">
                        <h3 class="mt-4 text-muted">Giỏ hàng đang trống</h3>
                        <a href="shop.php?cate=all" class="btn btn-primary btn-lg mt-3">Tiếp tục mua sắm</a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <!-- Danh sách sản phẩm -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <?php foreach ($cart as $id => $item): ?>
                                        <div class="mb-4 pb-4 border-bottom">
                                            <div class="row w-100 ">
                                                <div class="col-md-2 text-center">
                                                    <img src="products/<?= htmlspecialchars($item['image']) ?>"
                                                        class="rounded me-4 object-fit-contain" width="50">
                                                </div>
                                                <div class="col-md-5 text-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1"><?= htmlspecialchars($item['title']) ?></h6>
                                                        <p class="text-muted mb-2"><?= number_format($item['price'], 0, ',', '.') ?> đ</p>
                                                        <a href="cart.php?action=remove&id=<?= $id ?>"
                                                            class="text-danger small" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')">
                                                            <i class="bi bi-trash"></i> Xóa
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <div class="d-flex align-items-center">
                                                        <form action="cart.php?action=update&id=<?= $id ?>" method="post" class="d-inline me-3">
                                                            <div class="input-group" style="width: 140px;">
                                                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>"
                                                                    min="1" max="100" class="form-control form-control-sm" required>
                                                                <button type="submit" class="btn btn-outline-primary btn-sm">Cập nhật</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 text-end">

                                                    <strong class="fs-5 text-danger">
                                                        <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ
                                                    </strong>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="d-flex justify-content-between">
                                        <a href="shop.php?cate=all" class="btn btn-outline-secondary">
                                            Tiếp tục mua sắm
                                        </a>
                                        <a href="cart.php?action=clear" class="btn btn-outline-danger"
                                            onclick="return confirm('Xóa toàn bộ giỏ hàng?')">
                                            Xóa giỏ hàng
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="mb-4">Tóm tắt đơn hàng</h4>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tạm tính (<?= $cartStats['items'] ?> sản phẩm)</span>
                                        <strong><?= number_format($cartStats['total'], 0, ',', '.') ?> đ</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 text-success">
                                        <span>Tiết kiệm</span>
                                        <strong>0 đ</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <strong class="fs-5">Tổng cộng</strong>
                                        <strong class="fs-4 text-danger"><?= number_format($cartStats['total'], 0, ',', '.') ?> đ</strong>
                                    </div>

                                    <a href="checkout.php" class="btn btn-success btn-lg w-100">
                                        Tiến hành thanh toán
                                    </a>

                                    <div class="mt-4 text-center">
                                        <small class="text-muted">
                                            Bằng việc đặt hàng, bạn đồng ý với <a href="#">Điều khoản dịch vụ</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include('footer.php') ?>

    <!-- JS -->
    <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/theme.min.js"></script>
</body>

</html>