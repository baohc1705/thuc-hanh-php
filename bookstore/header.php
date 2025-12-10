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

    function getCartCount()
    {
      if (isset($_COOKIE['unibook_cart'])) {
        $cart = json_decode($_COOKIE['unibook_cart'], true);
        if (is_array($cart)) {
          return array_sum(array_column($cart, 'quantity'));
        }
      }
      return 0;
    }
    $cartCount = getCartCount();

    ?>
    <!-- navbar -->
    <div class="border-bottom">
      <div class="bg-light py-1">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-12 text-center text-md-start">
              <span>Ưu đãi siêu giá trị - Tiết kiệm nhiều hơn với phiếu giảm giá</span>
            </div>

          </div>
        </div>
      </div>
      <div class="py-5">
        <div class="container">
          <div class="row w-100 align-items-center gx-lg-2 gx-0">
            <div class="col-xxl-2 col-lg-3 col-md-6 col-5">
              <a class="navbar-brand d-none d-lg-block" href="index.php">
                <img
                  src="images/logo/logo-unibook.svg"
                  alt="eCommerce HTML Template"
                  height="50" />
              </a>
              <div class="d-flex justify-content-between w-100 d-lg-none">
                <a class="navbar-brand" href="index.php">
                  <img
                    src="images/logo/logo-unibook.svg"
                    alt="eCommerce HTML Template"
                    height="50" />
                </a>
              </div>
            </div>
            <div class="col-xxl-5 col-lg-5 d-none d-lg-block">
              <form action="#">
                <div class="input-group">
                  <input
                    class="form-control rounded"
                    type="search"
                    placeholder="Tìm kiếm sản phẩm" />
                  <span class="input-group-append">
                    <button
                      class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                      type="button">
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
                        class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </span>
                </div>
              </form>
            </div>
            <div class="col-md-2 col-xxl-3 d-none d-lg-block">
            </div>
            <div class="col-lg-2 col-xxl-2 text-end col-md-6 col-7">
              <div class="list-inline">

                <div class="list-inline-item me-5">
                  <a
                    href="#!"
                    class="text-muted"
                    data-bs-toggle="modal"
                    data-bs-target="#userModal">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="20"
                      height="20"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-user">
                      <path
                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  </a>
                </div>
                <!-- giỏ hàng -->
                <div class="list-inline-item me-5 me-lg-0">
                  <a
                    class="text-muted position-relative"
                    href="cart.php">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="20"
                      height="20"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-shopping-bag">
                      <path
                        d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                      <line x1="3" y1="6" x2="21" y2="6"></line>
                      <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <?php if ($cartCount > 0) : ?>
                      <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        <?= $cartCount ?>
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    <?php endif; ?>
                  </a>
                </div>
                <div class="list-inline-item d-inline-block d-lg-none">
                  <!-- Button -->
                  <button
                    class="navbar-toggler collapsed"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#navbar-default"
                    aria-controls="navbar-default"
                    aria-label="Toggle navigation">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="32"
                      height="32"
                      fill="currentColor"
                      class="bi bi-text-indent-left text-primary"
                      viewBox="0 0 16 16">
                      <path
                        d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <nav
        class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4"
        aria-label="Offcanvas navbar large">
        <div class="container">
          <div
            class="offcanvas offcanvas-start"
            tabindex="-1"
            id="navbar-default"
            aria-labelledby="navbar-defaultLabel">
            <div class="offcanvas-header pb-1">
              <a href="index.php"><img
                  src="images/logo/logo-unibook.svg"
                  alt="eCommerce HTML Template"
                  height="50" /></a>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div class="d-block d-lg-none mb-4">
                <form action="#">
                  <div class="input-group">
                    <input
                      class="form-control rounded"
                      type="search"
                      placeholder="Tìm kiếm sản phẩm" />
                    <span class="input-group-append">
                      <button
                        class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                        type="button">
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
                          class="feather feather-search">
                          <circle cx="11" cy="11" r="8"></circle>
                          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                      </button>
                    </span>
                  </div>
                </form>
                <div class="mt-2">

                </div>
              </div>
              <div class="d-block d-lg-none mb-4">
                <a
                  class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                  data-bs-toggle="collapse"
                  href="#collapseExample"
                  role="button"
                  aria-expanded="false"
                  aria-controls="collapseExample">
                  <span class="me-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-grid">
                      <rect x="3" y="3" width="7" height="7"></rect>
                      <rect x="14" y="3" width="7" height="7"></rect>
                      <rect x="14" y="14" width="7" height="7"></rect>
                      <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                  </span>
                  Danh mục
                </a>
                <div class="collapse mt-2" id="collapseExample">
                  <div class="card card-body">
                    <ul class="mb-0 list-unstyled">
                      <?php
                      foreach ($categories as $cate) {
                      ?>
                        <li>
                          <a class="dropdown-item" href="shop.php?cate=<?= $cate['id'] ?>"><?= $cate['name'] ?></a>
                        </li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="dropdown me-3 d-none d-lg-block">
                <button
                  class="btn btn-primary px-6"
                  type="button"
                  id="dropdownMenuButton1"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <span class="me-1">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-grid">
                      <rect x="3" y="3" width="7" height="7"></rect>
                      <rect x="14" y="3" width="7" height="7"></rect>
                      <rect x="14" y="14" width="7" height="7"></rect>
                      <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                  </span>
                  Danh mục
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <?php
                  foreach ($categories as $cate) {
                  ?>
                    <li>
                      <a class="dropdown-item" href="shop.php?cate=<?= $cate['id'] ?>"><?= $cate['name'] ?></a>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
              <div>
                <ul class="navbar-nav align-items-center">
                  <li class="nav-item w-100 w-lg-auto">
                    <a href="index.php"
                      class="nav-link">Trang chủ</a>
                  </li>
                  <li class="nav-item w-100 w-lg-auto">
                    <a class="nav-link" href="shop.php?cate=all">Sản phẩm</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>




    <script src="js/vendors/validation.js"></script>