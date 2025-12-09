<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:49 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Codescandy" name="author" />
    <title>Dashboard eCommerce HTML Template - FreshCart</title>
    <!-- Favicon icon-->
    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="../images/favicon/favicon.ico" />

    <!-- Libs CSS -->
    <link
        href="../libs/bootstrap-icons/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link
        href="../libs/feather-webfont/dist/feather-icons.css"
        rel="stylesheet" />
    <link
        href="../libs/simplebar/dist/simplebar.min.css"
        rel="stylesheet" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../css/theme.min.css" />
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-M8S4MT3EYG");
    </script>
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function() {
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
                                    <h2>Categories</h2>
                                    <!-- breacrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                                        </ol>
                                    </nav>
                                </div>
                                <!-- button -->
                                <div>
                                    <a href="add-category.html" class="btn btn-primary">Add New Category</a>
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
                                                <option selected>Status</option>
                                                <option value="Published">Published</option>
                                                <option value="Unpublished">Unpublished</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-body p-0">
                                    <!-- table -->
                                    <div class="table-responsive">
                                        <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Icon</th>
                                                    <th>Name</th>
                                                    <th>Proudct</th>
                                                    <th>Status</th>

                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryOne" />
                                                            <label class="form-check-label" for="categoryOne"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/snacks.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Snack & Munchies</a></td>
                                                    <td>12</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryTwo" />
                                                            <label class="form-check-label" for="categoryTwo"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/bakery.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Bakery & Biscuits</a></td>
                                                    <td>8</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryThree" />
                                                            <label class="form-check-label" for="categoryThree"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/baby-food.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Baby Care</a></td>
                                                    <td>32</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryFour" />
                                                            <label class="form-check-label" for="categoryFour"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/wine.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Cold Drinks & Juices</a></td>
                                                    <td>34</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryFive" />
                                                            <label class="form-check-label" for="categoryFive"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/toiletries.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Toiletries</a></td>
                                                    <td>23</td>

                                                    <td>
                                                        <span class="badge bg-light-danger text-dark-danger">Unpublished</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categorySeven" />
                                                            <label class="form-check-label" for="categorySeven"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/dairy.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Dairy, Bread & Eggs</a></td>
                                                    <td>16</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryEight" />
                                                            <label class="form-check-label" for="categoryEight"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/fish.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Chicken, Meat & Fish</a></td>
                                                    <td>14</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryNine" />
                                                            <label class="form-check-label" for="categoryNine"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/fruit.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Fruits & Vegetables</a></td>
                                                    <td>32</td>

                                                    <td>
                                                        <span class="badge bg-light-primary text-dark-primary">Published</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="categoryTen" />
                                                            <label class="form-check-label" for="categoryTen"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#!"><img src="../assets/images/icons/petfoods.svg" alt="" class="icon-shape icon-sm" /></a>
                                                    </td>
                                                    <td><a href="#" class="text-reset">Pet Food</a></td>
                                                    <td>25</td>

                                                    <td>
                                                        <span class="badge bg-light-danger text-dark-danger">Unpublished</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-trash me-3"></i>
                                                                        Delete
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="bi bi-pencil-square me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="border-top d-flex justify-content-between align-items-md-center px-6 py-6 flex-md-row flex-column gap-4">
                                    <span>Showing 1 to 8 of 12 entries</span>
                                    <nav>
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
                                            <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Libs JS -->
    <!-- <script src="../libs/jquery/dist/jquery.min.js"></script> -->
    <script src="../libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../js/theme.min.js"></script>

    <script src="../libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../js/vendors/chart.js"></script>
</body>

<!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:53 GMT -->

</html>