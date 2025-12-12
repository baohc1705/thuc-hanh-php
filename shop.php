<?php
include('config/config.php');
session_start();
function buildUrl($params = [])
{
   $url = $_SERVER['REQUEST_URI'];
   $parts = parse_url($url);
   $query = [];
   if (isset($parts['query'])) parse_str($parts['query'], $query);
   $query = array_merge($query, $params);
   return htmlspecialchars($parts['path'] . '?' . http_build_query($query));
}


$err = '';
$products = [];
$category = null;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$productsPerPage = 12;
$totalProducts = 0;
$totalPages = 1;

try {
   $sql = 'SELECT * FROM category c WHERE c.status = 1 ORDER BY c.name';
   $stmt = $pdo->query($sql);
   $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
   $err .= $e->getMessage();
}

if (isset($_GET['cate'])) {
   $cateValue = $_GET['cate'];
   $sort = $_GET['sort'] ?? 'newest';


   $allowedSorts = [
      'newest'     => 'p.createAt DESC',
      'price_asc'  => 'p.price ASC',
      'price_desc' => 'p.price DESC',
   ];

   $orderBy = $allowedSorts['newest'] ?? 'p.createAt DESC';
   if (isset($allowedSorts[$sort])) {
      $orderBy = $allowedSorts[$sort];
   }

   try {
      if ($cateValue === 'all') {
         // === TẤT CẢ SẢN PHẨM ===
         $sqlCount = 'SELECT COUNT(*) as total FROM product WHERE status = 1';
         $stmtCount = $pdo->query($sqlCount);
         $totalProducts = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

         $offset = ($currentPage - 1) * $productsPerPage;

         $sql = "SELECT p.*, c.name as category_name
                 FROM product p
                 LEFT JOIN category c ON p.category_id = c.id
                 WHERE p.status = 1
                 ORDER BY $orderBy
                 LIMIT :limit OFFSET :offset";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
         $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
         $stmt->execute();
         $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

         $category = ['id' => 'all', 'name' => 'Tất cả sản phẩm'];
      } else {
         // === THEO DANH MỤC ===
         $cateId = (int)$cateValue;

         $stmt2 = $pdo->prepare('SELECT * FROM category WHERE id = ? AND status = 1 LIMIT 1');
         $stmt2->execute([$cateId]);
         $category = $stmt2->fetch(PDO::FETCH_ASSOC);

         if (!$category) {
            $err = "Danh mục không tồn tại hoặc đã bị ẩn!";
         } else {
            $sqlCount = 'SELECT COUNT(*) as total FROM product WHERE category_id = ? AND status = 1';
            $stmtCount = $pdo->prepare($sqlCount);
            $stmtCount->execute([$cateId]);
            $totalProducts = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

            $offset = ($currentPage - 1) * $productsPerPage;

            $sql = "SELECT p.*, c.name as category_name
                    FROM product p
                    LEFT JOIN category c ON p.category_id = c.id
                    WHERE p.category_id = :cate_id AND p.status = 1
                    ORDER BY $orderBy
                    LIMIT :limit OFFSET :offset";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':cate_id', $cateId, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
      }

      $totalPages = ceil($totalProducts / $productsPerPage);

      if ($currentPage > $totalPages && $totalPages > 0) $currentPage = $totalPages;
      if ($currentPage < 1) $currentPage = 1;
   } catch (PDOException $e) {
      $err .= 'Lỗi database: ' . $e->getMessage();
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <title>Trang sản phẩm</title>
   <?php include('include/lib.php') ?>
</head>

<body>
   <?php include('header.php') ?>

   <main>
      <!-- section-->
      <div class="mt-4">
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- col -->
               <div class="col-12">
                  <!-- breadcrumb -->
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="shop.php?cate=all">Tất cả sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $category ? htmlspecialchars($category['name']) : 'Shop' ?></li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <!-- section -->
      <div class="mt-8 mb-lg-14 mb-8">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row gx-10">
               <!-- col -->
               <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                  <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1" id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                     <div class="offcanvas-header d-lg-none">
                        <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                     </div>
                     <div class="offcanvas-body ps-lg-2 pt-lg-0">
                        <div class="mb-8">
                           <!-- title -->
                           <h5 class="mb-3">Danh mục</h5>
                           <!-- nav -->
                           <div class="list-group">
                              <a href="shop.php?cate=all" class="list-group-item list-group-item-action <?= isset($_GET['cate']) && $_GET['cate'] === 'all' ? 'active' : '' ?>">Tất cả sản phẩm</a>
                              <?php
                              foreach ($categories as $cate) {
                              ?>
                                 <a href="shop.php?cate=<?= $cate['id'] ?>" class="list-group-item list-group-item-action <?= isset($_GET['cate']) && $_GET['cate'] == $cate['id'] ? 'active' : '' ?>"><?= htmlspecialchars($cate['name']) ?></a>
                              <?php
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </aside>
               <section class="col-lg-9 col-md-12">
                  <!-- card -->
                  <div class="card mb-4 bg-light border-0">
                     <!-- card body -->
                     <div class="card-body p-9">
                        <h2 class="mb-0 fs-1"><?= $category ? htmlspecialchars($category['name']) : 'Shop' ?></h2>
                     </div>
                  </div>
                  <!-- list icon -->
                  <div class="d-lg-flex justify-content-between align-items-center">
                     <div class="mb-3 mb-lg-0">
                        <p class="mb-0">
                           <span class="text-dark"><?= $totalProducts ?></span>
                           Sản phẩm tìm thấy
                        </p>
                     </div>

                     <!-- icon -->
                     <div class="d-md-flex justify-content-between align-items-center">
                        <div class="d-flex mt-2 mt-lg-0">
                           <div>
                              <select class="form-select" id="sortSelect" onchange="applySort()">
                                 <option value="newest" <?= (!isset($_GET['sort']) || $_GET['sort'] === 'newest') ? 'selected' : '' ?>>
                                    Mới nhất
                                 </option>
                                 <option value="price_asc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'price_asc') ? 'selected' : '' ?>>
                                    Giá: Thấp → Cao
                                 </option>
                                 <option value="price_desc" <?= (isset($_GET['sort']) && $_GET['sort'] === 'price_desc') ? 'selected' : '' ?>>
                                    Giá: Cao → Thấp
                                 </option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                     <?php
                     if ($totalProducts == 0) {
                     ?>
                        <div class="alert alert-primary w-100 text-center fs-3" role="alert">
                           Không tìm thấy sản phẩm nào !
                        </div>
                        <?php
                     } else {
                        foreach ($products as $p) {
                        ?>
                           <div class="col">
                              <!-- card -->
                              <div class="card card-product">
                                 <div class="card-body">
                                    <!-- badge -->
                                    <div class="text-center position-relative">
                                       <!-- img -->
                                       <img src="products/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name'] ?? $p['title'] ?? '') ?>" class="mb-3 object-fit-contain" width="150" height="200" />
                                    </div>
                                    <!-- heading -->
                                    <div class="text-small mb-1">
                                       <small><?= htmlspecialchars($p['category_name'] ?? '') ?></small>
                                    </div>
                                    <h2 class="fs-6"><?= htmlspecialchars($p['title'] ?? '') ?></h2>

                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                       <div>
                                          <span class="text-danger fw-semibold">
                                             <?= number_format($p['price'], 0, ',', '.') ?> đ
                                          </span>
                                       </div>

                                       <!-- btn -->
                                       <div>
                                          <a href="cart.php?action=add&id=<?= $p['id'] ?>&title=<?= urlencode($p['title']) ?>&price=<?= $p['price'] ?>&image=<?= $p['image'] ?>" class="btn btn-primary btn-sm">
                                             <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                             </svg>
                                             Thêm
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     <?php
                        }
                     }
                     ?>

                  </div>

                  <!-- Pagination -->
                  <?php if ($totalPages > 1): ?>
                     <div class="row mt-8">
                        <div class="col">
                           <nav aria-label="Page navigation">
                              <ul class="pagination justify-content-center">

                                 <!-- Previous -->
                                 <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= buildUrl(['page' => $currentPage - 1]) ?>" aria-label="Previous">
                                       <i class="feather-icon icon-chevron-left"></i>
                                    </a>
                                 </li>

                                 <?php
                                 $startPage = max(1, $currentPage - 2);
                                 $endPage = min($totalPages, $currentPage + 2);

                                 // Trang 1 + ...
                                 if ($startPage > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . buildUrl(['page' => 1]) . '">1</a></li>';
                                    if ($startPage > 2) {
                                       echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                 }

                                 // Các trang ở giữa
                                 for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i === $currentPage ? 'active' : '';
                                    echo '<li class="page-item ' . $active . '">
                                             <a class="page-link" href="' . buildUrl(['page' => $i]) . '">' . $i . '</a>
                                          </li>';
                                 }

                                 // ... + trang cuối
                                 if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                       echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . buildUrl(['page' => $totalPages]) . '">' . $totalPages . '</a></li>';
                                 }
                                 ?>

                                 <!-- Next -->
                                 <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= buildUrl(['page' => $currentPage + 1]) ?>" aria-label="Next">
                                       <i class="feather-icon icon-chevron-right"></i>
                                    </a>
                                 </li>

                              </ul>
                           </nav>
                        </div>
                     </div>
                  <?php endif; ?>
               </section>
            </div>
         </div>
      </div>
   </main>

   <?php include('footer.php') ?>
   <!-- Javascript-->
   <script>
      function applySort() {
         const sort = document.getElementById('sortSelect').value;
         const currentUrl = new URL(window.location);
         currentUrl.searchParams.set('sort', sort);
         // Giữ lại cate và page nếu có
         window.location = currentUrl.toString();
      }
   </script>
   <!-- Libs JS -->
   <script src="libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="libs/simplebar/dist/simplebar.min.js"></script>

   <!-- Theme JS -->
   <script src="js/theme.min.js"></script>

   <script src="js/vendors/jquery.min.js"></script>
   <script src="js/vendors/countdown.js"></script>
   <script src="libs/slick-carousel/slick/slick.min.js"></script>
   <script src="js/vendors/slick-slider.js"></script>
   <script src="libs/tiny-slider/dist/min/tiny-slider.js"></script>
   <script src="js/vendors/tns-slider.js"></script>
   <script src="js/vendors/zoom.js"></script>
</body>

</html>