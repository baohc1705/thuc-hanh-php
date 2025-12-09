<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta content="Codescandy" name="author" />
    <title>Homepage v1 - eCommerce HTML Template - FreshCart</title>

    <link href="libs/slick-carousel/slick/slick.css" rel="stylesheet" />
    <link
      href="libs/slick-carousel/slick/slick-theme.css"
      rel="stylesheet"
    />
    <link
      href="libs/tiny-slider/dist/tiny-slider.css"
      rel="stylesheet"
    />

    <!-- Favicon icon-->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="images/favicon/favicon.ico"
    />

    <!-- Libs CSS -->
    <link
      href="libs/bootstrap-icons/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link
      href="libs/feather-webfont/dist/feather-icons.css"
      rel="stylesheet"
    />
    <link
      href="libs/simplebar/dist/simplebar.min.css"
      rel="stylesheet"
    />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/theme.min.css" />
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "G-M8S4MT3EYG");
    </script>
    <script type="text/javascript">
      (function (c, l, a, r, i, t, y) {
        c[a] =
          c[a] ||
          function () {
            (c[a].q = c[a].q || []).push(arguments);
          };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
      })(window, document, "clarity", "script", "kuc8w5o9nt");
    </script>
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
              "
            >
              <div
                class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center"
              >
                <span class="badge text-bg-warning"
                  >Opening Sale Discount 50%</span
                >

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
              "
            >
              <div
                class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center"
              >
                <span class="badge text-bg-warning"
                  >Free Shipping - orders over $100</span
                >
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
              <h3 class="mb-0">Featured Categories</h3>
            </div>
          </div>
          <div class="category-slider">
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-comic-dc.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3 img-fluid"
                    />
                    <div class="text-truncate">Dairy, Bread & Eggs</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-comic.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Snack & Munchies</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-do-choi.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Bakery & Biscuits</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-it.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Instant Food</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-manga.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Tea, Coffee & Drinks</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-mau-ve.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Atta, Rice & Dal</div>
                  </div>
                </div>
              </a>
            </div>

            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-thu-bong.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Baby Care</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-tieu-thuyet.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Chicken, Meat & Fish</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-van-hoc.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Cleaning Essentials</div>
                  </div>
                </div>
              </a>
            </div>
            <div class="item">
              <a
                href="pages/shop-grid.html"
                class="text-decoration-none text-inherit"
              >
                <div class="card card-product mb-lg-4">
                  <div class="card-body text-center py-8">
                    <img
                      src="images/category/category-van-phong.png"
                      alt="Grocery Ecommerce Template"
                      class="mb-3"
                    />
                    <div class="text-truncate">Pet Care</div>
                  </div>
                </div>
              </a>
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
                  "
                >
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
                  "
                >
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
              <h3 class="mb-0">Popular Products</h3>
            </div>
          </div>

          <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <div class="position-absolute top-0 start-0">
                      <span class="badge bg-danger">Sale</span>
                    </div>
                    <a href="#!"
                      ><img
                        src="products/product-img-1.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>

                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Snack & Munchies</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Haldiram's Sev Bhujia</a
                    >
                  </h2>
                  <div>
                    <small class="text-warning">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5(149)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$18</span>
                      <span class="text-decoration-line-through text-muted"
                        >$24</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <div class="position-absolute top-0 start-0">
                      <span class="badge bg-success">14%</span>
                    </div>
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-2.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Bakery & Biscuits</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >NutriChoice Digestive</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5 (25)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div><span class="text-dark">$24</span></div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-3.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Bakery & Biscuits</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Cadbury 5 Star Chocolate</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </small>
                    <span class="text-muted small">5 (469)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$32</span>
                      <span class="text-decoration-line-through text-muted"
                        >$35</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-4.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                    <div class="position-absolute top-0 start-0">
                      <span class="badge bg-danger">Hot</span>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Snack & Munchies</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Onion Flavour Potato</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </small>
                    <span class="text-muted small">3.5 (456)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$3</span>
                      <span class="text-decoration-line-through text-muted"
                        >$5</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-5.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Instant Food</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Salted Instant Popcorn</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5 (39)</span>
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <div>
                      <span class="text-dark">$13</span>
                      <span class="text-decoration-line-through text-muted"
                        >$18</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <div class="position-absolute top-0 start-0">
                      <span class="badge bg-danger">Sale</span>
                    </div>
                    <a href="#!"
                      ><img
                        src="products/product-img-6.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Dairy, Bread & Eggs</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Blueberry Greek Yogurt</a
                    >
                  </h2>
                  <div>
                    <small class="text-warning">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5 (189)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$18</span>
                      <span class="text-decoration-line-through text-muted"
                        >$24</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-7.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Dairy, Bread & Eggs</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Britannia Cheese Slices</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </small>
                    <span class="text-muted small">5 (345)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div><span class="text-dark">$24</span></div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-8.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Instant Food</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Kellogg's Original Cereals</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4 (90)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$32</span>
                      <span class="text-decoration-line-through text-muted"
                        >$35</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-9.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Snack & Munchies</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Slurrp Millet Chocolate</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span class="text-muted small">4.5 (67)</span>
                  </div>
                  <div
                    class="d-flex justify-content-between align-items-center mt-3"
                  >
                    <div>
                      <span class="text-dark">$3</span>
                      <span class="text-decoration-line-through text-muted"
                        >$5</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card card-product">
                <div class="card-body">
                  <div class="text-center position-relative">
                    <a href="pages/shop-single.html"
                      ><img
                        src="products/product-img-10.jpg"
                        alt="Grocery Ecommerce Template"
                        class="mb-3 img-fluid"
                    /></a>
                    <div class="card-product-action">
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"
                      >
                        <i
                          class="bi bi-eye"
                          data-bs-toggle="tooltip"
                          data-bs-html="true"
                          title="Quick View"
                        ></i>
                      </a>
                      <a
                        href="pages/shop-wishlist.html"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Wishlist"
                        ><i class="bi bi-heart"></i
                      ></a>
                      <a
                        href="#!"
                        class="btn-action"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="Compare"
                        ><i class="bi bi-arrow-left-right"></i
                      ></a>
                    </div>
                  </div>
                  <div class="text-small mb-1">
                    <a href="#!" class="text-decoration-none text-muted"
                      ><small>Dairy, Bread & Eggs</small></a
                    >
                  </div>
                  <h2 class="fs-6">
                    <a
                      href="pages/shop-single.html"
                      class="text-inherit text-decoration-none"
                      >Amul Butter - 500 g</a
                    >
                  </h2>
                  <div class="text-warning">
                    <small>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </small>
                    <span class="text-muted small">3.5 (89)</span>
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <div>
                      <span class="text-dark">$13</span>
                      <span class="text-decoration-line-through text-muted"
                        >$18</span
                      >
                    </div>
                    <div>
                      <a href="#!" class="btn btn-primary btn-sm">
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
                          class="feather feather-plus"
                        >
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
