<?php
include('../config/config.php');

$err_pdo = "";

try {
    $sql = "SELECT * FROM category";

    $stmt = $pdo->query($sql);

    $catogries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $err_pdo .= $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý danh mục - Unibook</title>
    <?php include("include/lib.php"); ?>
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
                <div class="container">
                    <!-- row -->
                    <div class="row mb-8">
                        <div class="col-md-12">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                                <!-- pageheader -->
                                <div>
                                    <h2>Quản lý danh mục</h2>
                                </div>
                                <!-- button -->
                                <div>
                                    <a href="./add-category.php" class="btn btn-primary">Thêm danh mục mới</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lg">
                                <div class="px-6 py-6">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                                            <!-- form -->
                                            <form class="d-flex" role="search">
                                                <input class="form-control" type="search" placeholder="Search Category" aria-label="Search" />
                                            </form>
                                        </div>
                                        <!-- select option -->
                                        <div class="col-xl-2 col-md-4 col-12">
                                            <select class="form-select">
                                                <option selected>Trạng thái</option>
                                                <option value="Published">Hoạt động</option>
                                                <option value="Unpublished">Không hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-body p-0">
                                    <?php
                                    if (isset($_GET['add']) && $_GET['add'] === 'success') {
                                    ?>
                                        <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>Đã thêm danh mục thành công!</span>
                                            </div>
                                            <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (isset($_GET['update']) && $_GET['update'] === 'success') {
                                    ?>
                                        <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>Đã cập nhật danh mục thành công!</span>
                                            </div>
                                            <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                     <?php
                                    if (isset($_GET['delete']) && $_GET['delete'] === 'success') {
                                    ?>
                                        <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert" id="alert">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-check-circle-fill"></i>
                                                <span>Đã xóa danh mục thành công!</span>
                                            </div>
                                            <button type="button" class="btn-close" onclick="document.getElementById('alert').remove()"></button>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                    <!-- table -->
                                    <div class="table-responsive">
                                        <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Ảnh</th>
                                                    <th>Tên loại</th>
                                                    <th>Mô tả</th>
                                                    <th>Trạng thái</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stt = 0;
                                                foreach ($catogries as $cate) {
                                                    $stt++;
                                                ?>
                                                    <tr>
                                                        <td><?= $stt ?></td>
                                                        <td><img src="../images/category/<?= $cate['image'] ?>" alt="<?= $cate['image'] ?>" width="50" class="object-fit-contain"></td>
                                                        <td><?= $cate['name'] ?></td>
                                                        <td><?= $cate['description'] ?></td>
                                                        <td>
                                                            <span class="<?= $cate['status'] ? 'badge bg-light-primary text-dark-primary' : 'badge bg-light-danger text-dark-danger' ?>"><?= $cate['status'] ? 'Hoạt động' : 'Không hoạt động' ?></span>
                                                        </td>

                                                        <td>
                                                            <a href="./delete-category.php?id=<?= $cate['id'] ?>" class="btn btn-danger">Xóa</a>
                                                            <a href="./edit-category.php?id=<?= $cate['id'] ?>" class="btn btn-warning">Sửa</a>
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../js/theme.min.js"></script>
    <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../js/vendors/chart.js"></script>
</body>

</html>