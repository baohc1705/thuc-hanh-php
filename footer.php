<?php
// Load config and categories for footer
include_once __DIR__ . '/config/config.php';

$categories = [];
try {
  $stmt = $pdo->prepare("SELECT id, name FROM category WHERE status = 1 ORDER BY name LIMIT 5");
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
<!-- footer -->
<footer class="footer bg-light">
  <div class="container">
    <div class="row g-4 py-4">
      <!-- CATEGORIES -->
      <div class="col-12 col-md-12 col-lg-4">

        <div class="row">
          <div class="col-6">
            <h6 class="mb-3">Về Unibook</h6>
            <p>Unibook — Nhà sách trực tuyến cung cấp sách giáo khoa, tham khảo, văn học và tài liệu học tập. Hỗ trợ giao hàng toàn quốc và chính sách đổi trả linh hoạt.</p>
            <ul class="list-unstyled small">
              <li>Địa chỉ: Hà Nội, Việt Nam</li>
              <li>Hotline: 1900-xxx-xxx</li>
              <li>Email: <a href="mailto:support@unibook.vn">support@unibook.vn</a></li>
            </ul>
          </div>
          <div class="col-6">
            <h6 class="mb-4">Danh mục sách</h6>
            <ul class="nav flex-column">
              <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                  <li class="nav-item mb-2">
                    <a class="nav-link" href="shop.php?category_id=<?= htmlspecialchars($cat['id']) ?>">
                      <?= htmlspecialchars($cat['name']) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="nav-item mb-2"><span class="text-muted">Chưa có danh mục</span></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- OTHER LINKS -->
      <div class="col-12 col-md-12 col-lg-8">
        <div class="row g-4">

          <div class="col-6 col-sm-6 col-md-3">
            <h6 class="mb-4">Về BookStore</h6>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Giới thiệu</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Tin tức</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Blog chia sẻ</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Trung tâm hỗ trợ</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Giá trị cốt lõi</a></li>
            </ul>
          </div>

          <div class="col-6 col-sm-6 col-md-3">
            <h6 class="mb-4">Dành cho khách hàng</h6>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Hình thức thanh toán</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Chính sách giao hàng</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Chính sách đổi trả</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Câu hỏi thường gặp</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Kiểm tra đơn hàng</a></li>
            </ul>
          </div>

          <div class="col-6 col-sm-6 col-md-3">
            <h6 class="mb-4">Hợp tác – Liên kết</h6>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Hợp tác xuất bản</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Bán sách cùng chúng tôi</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Chương trình cộng tác viên</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Tài liệu hỗ trợ</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Hệ thống nhà phát hành</a></li>
            </ul>
          </div>

          <div class="col-6 col-sm-6 col-md-3">
            <h6 class="mb-4">Chương trình & Ưu đãi</h6>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Mã giảm giá</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Ưu đãi thành viên</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Flash Sale</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Combo tiết kiệm</a></li>
              <li class="nav-item mb-2"><a href="#!" class="nav-link">Tuyển dụng</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <!-- Bottom: Payment -->
    <div class="border-top py-4">
      <div class="row align-items-center">
        <div class="col-lg-5 text-lg-start text-center mb-2 mb-lg-0">
          <ul class="list-inline mb-0">
            <li class="list-inline-item text-dark">Hỗ trợ thanh toán</li>
            <li class="list-inline-item"><img src="images/payment/visa.svg" alt=""></li>
            <li class="list-inline-item"><img src="images/payment/mastercard.svg" alt=""></li>
            <li class="list-inline-item"><img src="images/payment/paypal.svg" alt=""></li>
            <li class="list-inline-item"><img src="images/payment/american-express.svg" alt=""></li>
          </ul>
        </div>

        <div class="col-lg-7 mt-4 mt-md-0">
          <ul class="list-inline mb-0 text-lg-end text-center">
            <li class="list-inline-item mb-2 mb-md-0 text-dark">Tải ứng dụng BookStore</li>
            <li class="list-inline-item ms-4"><img src="images/appbutton/appstore-btn.svg" style="width:140px" alt=""></li>
            <li class="list-inline-item"><img src="images/appbutton/googleplay-btn.svg" style="width:140px" alt=""></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="border-top py-4">
      <div class="row align-items-center">
        <div class="col-md-6">
          <span class="small text-muted">© <span id="year"></span> BookStore – Nền tảng sách trực tuyến hàng đầu Việt Nam.</span>
        </div>
        <script>
          document.getElementById("year").textContent = new Date().getFullYear();
        </script>

        <div class="col-md-6">
          <ul class="list-inline text-md-end mb-0 small mt-3 mt-md-0">
            <li class="list-inline-item text-muted">Kết nối với chúng tôi</li>
            <li class="list-inline-item me-1"><a href="#!" class="btn btn-xs btn-social btn-icon"><i class="bi bi-facebook"></i></a></li>
            <li class="list-inline-item me-1"><a href="#!" class="btn btn-xs btn-social btn-icon"><i class="bi bi-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#!" class="btn btn-xs btn-social btn-icon"><i class="bi bi-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</footer>