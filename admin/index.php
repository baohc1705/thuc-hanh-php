<?php 
include('../config/_admin-auth.php');
include('../config/config.php');
session_start();

// Tổng quan
$totalRevenue = 0;
$totalOrders = 0;
$totalCustomers = 0;

// Doanh thu theo tháng (6 tháng gần nhất)
$revenueLabels = [];
$revenueData = [];

// Top 5 danh mục bán chạy
$topCateLabels = [];
$topCateData = [];

// 5 đơn hàng mới nhất
$latestOrders = [];

try {
  // Tổng doanh thu (chỉ tính đã thanh toán)
  $stmt = $pdo->query("SELECT COALESCE(SUM(total_price),0) FROM orders WHERE payment_status = 'paid'");
  $totalRevenue = (float)$stmt->fetchColumn();

  // Tổng số đơn
  $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
  $totalOrders = (int)$stmt->fetchColumn();

  // Tổng khách hàng
  $stmt = $pdo->query("SELECT COUNT(*) FROM users");
  $totalCustomers = (int)$stmt->fetchColumn();

  // Doanh thu 6 tháng gần nhất
  $stmt = $pdo->query("
    SELECT DATE_FORMAT(created_at, '%m/%Y') AS label,
           DATE_FORMAT(created_at, '%Y-%m') AS ym,
           SUM(total_price) AS total
    FROM orders
    WHERE payment_status = 'paid'
      AND created_at >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
    GROUP BY ym
    ORDER BY ym ASC
  ");
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $row) {
    $revenueLabels[] = $row['label'];
    $revenueData[] = (float)$row['total'];
  }

  // Top 5 category bán chạy nhất (theo tổng quantity)
  $stmt = $pdo->query("
    SELECT c.name, SUM(od.quantity) AS qty
    FROM order_detail od
    JOIN product p ON od.product_id = p.id
    JOIN category c ON p.category_id = c.id
    JOIN orders o ON od.order_id = o.id
    WHERE o.payment_status = 'paid'
    GROUP BY c.id, c.name
    ORDER BY qty DESC
    LIMIT 5
  ");
  $cates = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($cates as $c) {
    $topCateLabels[] = $c['name'];
    $topCateData[] = (int)$c['qty'];
  }

  // 5 đơn mới nhất
  $stmt = $pdo->query("
    SELECT id, recipient, total_price, status, payment_status, created_at
    FROM orders
    ORDER BY created_at DESC
    LIMIT 5
  ");
  $latestOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  // không hiển thị lỗi chi tiết ra UI dashboard
}

$statusClass = [
  'pending'   => ['label' => 'Chờ xử lý', 'class' => 'bg-light-warning text-dark-warning'],
  'confirmed' => ['label' => 'Đã xác nhận', 'class' => 'bg-light-primary text-dark-primary'],
  'shipping'  => ['label' => 'Đang giao', 'class' => 'bg-light-info text-dark-info'],
  'delivered' => ['label' => 'Đã giao', 'class' => 'bg-light-success text-dark-success'],
  'received' => ['label' => 'Đã nhận', 'class' => 'bg-light-info text-dark-success'],
  'cancelled' => ['label' => 'Đã hủy', 'class' => 'bg-light-danger text-dark-danger'],
];
?>

<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:49 GMT -->
  <head>
    <title>Dashboard - UniBook</title>
    <?php include('include/lib.php'); ?>
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
          <section class="container">
           
            <!-- table -->
            <div class="table-responsive-xl mb-6 mb-lg-0">
              <div class="row flex-nowrap pb-3 pb-lg-0">
                <div class="col-lg-4 col-12 mb-6">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                      <!-- heading -->
                      <div
                        class="d-flex justify-content-between align-items-center mb-6"
                      >
                        <div>
                          <h4 class="mb-0 fs-5">Doanh thu</h4>
                        </div>
                        <div
                          class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle"
                        >
                          <i class="bi bi-currency-dollar fs-5"></i>
                        </div>
                      </div>
                      <!-- project number -->
                      <div class="lh-1">
                        <h1 class="mb-2 fw-bold fs-2"><?= number_format($totalRevenue, 0, ',', '.') ?> đ</h1>
                        <span>Doanh thu đã thanh toán</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                      <!-- heading -->
                      <div
                        class="d-flex justify-content-between align-items-center mb-6"
                      >
                        <div>
                          <h4 class="mb-0 fs-5">Đơn hàng</h4>
                        </div>
                        <div
                          class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle"
                        >
                          <i class="bi bi-cart fs-5"></i>
                        </div>
                      </div>
                      <!-- project number -->
                      <div class="lh-1">
                        <h1 class="mb-2 fw-bold fs-2"><?= number_format($totalOrders, 0, ',', '.') ?></h1>
                        <span>Đơn hàng hiện tại</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                      <!-- heading -->
                      <div
                        class="d-flex justify-content-between align-items-center mb-6"
                      >
                        <div>
                          <h4 class="mb-0 fs-5">Khách hàng</h4>
                        </div>
                        <div
                          class="icon-shape icon-md bg-light-info text-dark-info rounded-circle"
                        >
                          <i class="bi bi-people fs-5"></i>
                        </div>
                      </div>
                      <!-- project number -->
                      <div class="lh-1">
                        <h1 class="mb-2 fw-bold fs-2"><?= number_format($totalCustomers, 0, ',', '.') ?></h1>
                        <span>Khách hàng</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- row -->
            <div class="row">
              <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                  <div class="card-body p-6">
                    <!-- heading -->
                    <div class="d-flex justify-content-between">
                      <div>
                        <h3 class="mb-1 fs-5">Doanh thu 6 tháng gần nhất</h3>
                        <small>Chỉ tính đơn đã thanh toán</small>
                      </div>
                    </div>
                    <!-- chart -->
                    <canvas id="revenueChart" class="mt-6" height="120"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                  <!-- card body -->
                  <div class="card-body p-6">
                    <!-- heading -->
                    <h3 class="mb-0 fs-5">Top 5 danh mục bán chạy</h3>
                    <div class="mt-4">
                      <canvas id="catePieChart" height="220"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- row -->
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                <div class="card h-100 card-lg">
                  <!-- heading -->
                  <div class="p-6">
                    <h3 class="mb-0 fs-5">5 đơn hàng mới nhất</h3>
                  </div>
                  <div class="card-body p-0">
                    <!-- table -->
                    <div class="table-responsive">
                      <table
                        class="table table-centered table-borderless text-nowrap table-hover"
                      >
                        <thead class="bg-light">
                          <tr>
                            <th scope="col">Mã đơn</th>
                            <th scope="col">Người nhận</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col" class="text-end">Tổng tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (empty($latestOrders)): ?>
                            <tr>
                              <td colspan="6" class="text-center py-4 text-muted">Chưa có đơn hàng</td>
                            </tr>
                          <?php else: ?>
                            <?php foreach ($latestOrders as $o): 
                              $pstatus = $o['payment_status'] === 'paid' ? 'bg-light-primary text-dark-primary' : 'bg-light-warning text-dark-warning';
                              $statusLabel = $statusClass[$o['status']]['label'] ?? $o['status'];
                              $statusBadge = $statusClass[$o['status']]['class'] ?? 'bg-light-secondary text-dark-secondary';
                            ?>
                              <tr>
                                <td>#<?= htmlspecialchars($o['id']) ?></td>
                                <td><?= htmlspecialchars($o['recipient']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                                <td><span class="badge <?= $pstatus ?>"><?= $o['payment_status'] === 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' ?></span></td>
                                <td><span class="badge <?= $statusBadge ?>"><?= htmlspecialchars($statusLabel) ?></span></td>
                                <td class="text-end text-danger fw-bold"><?= number_format($o['total_price'], 0, ',', '.') ?> đ</td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main>
      </div>
    </div>

    <!-- Libs JS -->
    <!-- <script src="../libs/jquery/dist/jquery.min.js"></script> -->
    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../js/theme.min.js"></script>

    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const revenueLabels = <?= json_encode($revenueLabels, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
      const revenueData   = <?= json_encode($revenueData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
      const cateLabels    = <?= json_encode($topCateLabels, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
      const cateData      = <?= json_encode($topCateData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

      // Revenue line chart
      const ctxRevenue = document.getElementById('revenueChart');
      if (ctxRevenue) {
        new Chart(ctxRevenue, {
          type: 'line',
          data: {
            labels: revenueLabels,
            datasets: [{
              label: 'Doanh thu (đ)',
              data: revenueData,
              borderColor: '#0d6efd',
              backgroundColor: 'rgba(13,110,253,0.1)',
              tension: 0.3,
              fill: true,
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false },
              tooltip: {
                callbacks: {
                  label: ctx => new Intl.NumberFormat('vi-VN').format(ctx.parsed.y) + ' đ'
                }
              }
            },
            scales: {
              y: {
                ticks: {
                  callback: value => new Intl.NumberFormat('vi-VN').format(value)
                },
                beginAtZero: true
              }
            }
          }
        });
      }

      // Category pie chart
      const ctxPie = document.getElementById('catePieChart');
      if (ctxPie) {
        new Chart(ctxPie, {
          type: 'pie',
          data: {
            labels: cateLabels,
            datasets: [{
              data: cateData,
              backgroundColor: ['#0d6efd','#6f42c1','#198754','#dc3545','#fd7e14'],
            }]
          },
          options: {
            plugins: {
              legend: { position: 'bottom' }
            }
          }
        });
      }
    </script>
  </body>

  <!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:53 GMT -->
</html>
