<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- navbar vertical -->
<!-- navbar -->
<nav class="navbar-vertical-nav d-none d-xl-block">
  <div class="navbar-vertical">
    <div class="px-4 py-5">
      <a href="index.php" class="navbar-brand">
        <img src="../images/logo/logo-unibook.svg" alt="" />
      </a>
    </div>
    <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
      <ul class="navbar-nav flex-column" id="sideNavbar">
        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-house"></i></span>
              <span class="nav-link-text">Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item mt-6 mb-3">
          <span class="nav-label">Quản lý cửa hàng</span>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'products.php' ? 'active' : '' ?>" href="products.php">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
              <span class="nav-link-text">Sản phẩm</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'categories.php' ? 'active' : '' ?>" href="categories.php">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
              <span class="nav-link-text">Danh mục</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'orders.php' ? 'active' : '' ?>" href="orders.php">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
              <span class="nav-link-text">Đơn hàng</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page == 'users.php' ? 'active' : '' ?>" href="users.php">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-people"></i></span>
              <span class="nav-link-text">Người dùng</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<nav
  class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac"
  tabindex="-1"
  id="offcanvasExample">
  <div class="navbar-vertical">
    <div
      class="px-4 py-5 d-flex justify-content-between align-items-center">
      <a href="../index.html" class="navbar-brand">
        <img src="../images/logo/logo-unibook.svg" alt="" />
      </a>
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
      <ul class="navbar-nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="index.html">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-house"></i></span>
              <span>Trang quản trị chung</span>
            </div>
          </a>
        </li>
        <li class="nav-item mt-6 mb-3">
          <span class="nav-label">Quản lý cửa hàng</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.html">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
              <span class="nav-link-text">Sản phẩm</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.html">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
              <span class="nav-link-text">Danh mục</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.html">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
              <span class="nav-link-text">Đơn hàng</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.html">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon"><i class="bi bi-people"></i></span>
              <span class="nav-link-text">Người dùng</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>