<?php
include('config/config.php');
$err = "";
try {
  $sql = 'SELECT * FROM category c WHERE c.status = 1 ORDER BY c.name';
  $stmt = $pdo->query($sql);

  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $err .= $e->getMessage();
}

$products = [];

try {
  $sql = 'SELECT p.*, c.name as category_name
        FROM product p
        LEFT JOIN category c on p.category_id = c.id
        WHERE p.status = 1
        ORDER BY p.createAt DESC
        LIMIT 10';
  $stmt = $pdo->query($sql);
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $err .= $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cửa hàng sách - Unibook</title>
  <?php include('include/lib.php') ?>
</head>

<body>
  <?php include('header.php') ?>

  <main>
    <section class="mt-8">
      <div class="container">
        <div class="hero-slider">
          <div
            style="
                background: url(images/slider/slide-1.jpg) no-repeat;
                background-size: cover;
                border-radius: 0.5rem;
                background-position: center;
              ">
            <div
              class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
              <span class="badge text-bg-warning">Opening Sale Discount 50%</span>

              <h2 class="text-dark display-5 fw-bold mt-4">
                SuperMarket For Fresh Grocery
              </h2>
              <p class="lead">
                Introduced a new model for online grocery shopping and
                convenient home delivery.
              </p>
              <a href="#!" class="btn btn-dark mt-3">
                Shop Now
                <i class="feather-icon icon-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
          <div
            style="
                background: url(images/slider/slider-2.jpg) no-repeat;
                background-size: cover;
                border-radius: 0.5rem;
                background-position: center;
              ">
            <div
              class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
              <span class="badge text-bg-warning">Free Shipping - orders over $100</span>
              <h2 class="text-dark display-5 fw-bold mt-4">
                Free Shipping on
                <br />
                orders over
                <span class="text-primary">$100</span>
              </h2>
              <p class="lead">
                Free Shipping to First-Time Customers Only, After promotions
                and discounts are applied.
              </p>
              <a href="#!" class="btn btn-dark mt-3">
                Shop Now
                <i class="feather-icon icon-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Category Section Start-->
    <section class="mb-lg-10 mt-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-6">
            <h3 class="mb-0">Danh mục nổi bật</h3>
          </div>
        </div>
        <div class="category-slider">
          <?php
          $sl = 0;
          foreach ($categories as $cate) {
            $sl++;
            if ($sl == 10)
              break;
          ?>
            <div class="item">
              <a
                href="shop.php?cate=<?= $cate['id'] ?>"
                class="text-decoration-none text-inherit">
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/<?= $cate['image'] ?>"
                      alt="<?= $cate['image'] ?>"
                      class="mb-3 img-fluid object-fit-contain" height="120" width="120"/>
                    <div class="text-truncate"><?= $cate['name'] ?></div>
                  </div>
                </div>
              </a>
            </div>
          <?php
          }
          ?>

        </div>
      </div>
      </div>
    </section>
    <!-- Category Section End-->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 mb-3 mb-lg-0">
            <div>
              <div
                class="py-10 px-8 rounded"
                style="
                    background: url(images/banner/grocery-banner.png)
                      no-repeat;
                    background-size: cover;
                    background-position: center;
                  ">
                <div>
                  <h3 class="fw-bold mb-1">Fruits & Vegetables</h3>
                  <p class="mb-4">
                    Get Upto
                    <span class="fw-bold">30%</span>
                    Off
                  </p>
                  <a href="#!" class="btn btn-dark">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div>
              <div
                class="py-10 px-8 rounded"
                style="
                    background: url(images/banner/grocery-banner-2.jpg)
                      no-repeat;
                    background-size: cover;
                    background-position: center;
                  ">
                <div>
                  <h3 class="fw-bold mb-1">Freshly Baked Buns</h3>
                  <p class="mb-4">
                    Get Upto
                    <span class="fw-bold">25%</span>
                    Off
                  </p>
                  <a href="#!" class="btn btn-dark">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Popular Products Start-->
    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-6">
            <h3 class="mb-0">Sản phẩm mới nhất</h3>
          </div>
        </div>

        <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
          <?php
          foreach ($products as $p) {
          ?>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <img
                        src="products/<?= $p['image'] ?>"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 object-fit-contain" 
                        width="200" height="300"
                        />

                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal">
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"></i>
                      </a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"><i class="bi bi-heart"></i></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <small><?= $p['category_name'] ?></small>
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="#"
                      class="text-inherit text-decoration-none"><?= $p['title'] ?></a>
                  </h2>
                  
                  <div
                    class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                      <span class="text-danger fw-semibold"><?= number_format($p['price'], 0, ',', '.') ?> đ</span>
                    </div>
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
          ?>

        </div>
      </div>
    </section>

    <section class="my-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="mb-8 mb-xl-0">
              <div class="mb-6">
                <img src="images/icons/clock.svg" alt="" />
              </div>
              <h3 class="h5 mb-3">10 minute grocery now</h3>
              <p>
                Get your order delivered to your doorstep at the earliest from
                FreshCart pickup stores near you.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="mb-8 mb-xl-0">
              <div class="mb-6">
                <img src="images/icons/gift.svg" alt="" />
              </div>
              <h3 class="h5 mb-3">Best Prices & Offers</h3>
              <p>
                Cheaper prices than your local supermarket, great cashback
                offers to top it off. Get best pricess & offers.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="mb-8 mb-xl-0">
              <div class="mb-6">
                <img src="images/icons/package.svg" alt="" />
              </div>
              <h3 class="h5 mb-3">Wide Assortment</h3>
              <p>
                Choose from 5000+ products across food, personal care,
                household, bakery, veg and non-veg & other categories.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="mb-8 mb-xl-0">
              <div class="mb-6">
                <img src="images/icons/refresh-cw.svg" alt="" />
              </div>
              <h3 class="h5 mb-3">Easy Returns</h3>
              <p>
                Not satisfied with a product? Return it at the doorstep & get
                a refund within hours. No questions asked
                <a href="#!">policy</a>
                .
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include('footer.php') ?>
  <!-- Javascript-->

  <!-- Libs JS -->
  <!-- <script src="./libs/jquery/dist/jquery.min.js"></script> -->
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

<!-- Mirrored from freshcart.codescandy.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:12 GMT -->

</html>