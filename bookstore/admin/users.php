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
          <div class="row mb-8">
            <div class="col-md-12">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                <div>
                  <h2>Customers</h2>
                  <!-- breacrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Customers</li>
                    </ol>
                  </nav>
                </div>
                <div>
                  <a href="create-customers.html" class="btn btn-primary">Add New Customer</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-12 mb-5">
              <div class="card h-100 card-lg">
                <div class="p-6">
                  <div class="row justify-content-between">
                    <div class="col-md-4 col-12">
                      <form class="d-flex" role="search">
                        <label for="searchCustomers" class="visually-hidden">Search Customers</label>
                        <input class="form-control" type="search" id="searchCustomers" placeholder="Search Customers" aria-label="Search" />
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                      <thead class="bg-light">
                        <tr>
                          <th>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                              <label class="form-check-label" for="checkAll"></label>
                            </div>
                          </th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Purchase Date</th>
                          <th>Phone</th>
                          <th>Spent</th>

                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerOne" />
                              <label class="form-check-label" for="customerOne"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Bonnie Howe</a>
                              </div>
                            </div>
                          </td>
                          <td>bonniehowe@gmail.com</td>

                          <td>17 May, 2023 at 3:18pm</td>
                          <td>-</td>
                          <td>$49.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerTwo" />
                              <label class="form-check-label" for="customerTwo"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-2.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Judy Nelson</a>
                              </div>
                            </div>
                          </td>
                          <td>judynelson@gmail.com</td>

                          <td>27 April, 2023 at 2:47pm</td>
                          <td>435-239-6436</td>
                          <td>$490.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerThree" />
                              <label class="form-check-label" for="customerThree"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-3.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">John Mattox</a>
                              </div>
                            </div>
                          </td>
                          <td>johnmattox@gmail.com</td>

                          <td>27 April, 2023 at 2:47pm</td>
                          <td>347-424-9526</td>
                          <td>$29.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerFour" />
                              <label class="form-check-label" for="customerFour"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-4.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Wayne Rossman</a>
                              </div>
                            </div>
                          </td>
                          <td>waynerossman@gmail.com</td>

                          <td>27 April, 2023 at 2:47pm</td>
                          <td>-</td>
                          <td>$39.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerFive" />
                              <label class="form-check-label" for="customerFive"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-5.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Rhonda Pinson</a>
                              </div>
                            </div>
                          </td>
                          <td>rhondapinson@gmail.com</td>

                          <td>18 March, 2023 at 2:47pm</td>
                          <td>304-471-8451</td>
                          <td>$213.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerSix" />
                              <label class="form-check-label" for="customerSix"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-6.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">John Mattox</a>
                              </div>
                            </div>
                          </td>
                          <td>johnmattox@gmail.com</td>

                          <td>18 March, 2023 at 2:47pm</td>
                          <td>410-636-2682</td>
                          <td>$490.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerSeven" />
                              <label class="form-check-label" for="customerSeven"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-7.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Wayne Rossman</a>
                              </div>
                            </div>
                          </td>
                          <td>waynerossman@gmail.com</td>

                          <td>18 March, 2023 at 2:47pm</td>
                          <td>845-294-6681</td>
                          <td>$39.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerEight" />
                              <label class="form-check-label" for="customerEight"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-8.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Richard Shelton</a>
                              </div>
                            </div>
                          </td>
                          <td>richarddhelton@jourrapide.com</td>

                          <td>12 March, 2023 at 9:47am</td>
                          <td>313-887-8495</td>
                          <td>$19.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerNine" />
                              <label class="form-check-label" for="customerNine"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-9.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Stephanie Morales</a>
                              </div>
                            </div>
                          </td>
                          <td>stephaniemorales@gmail.com</td>

                          <td>22 Feb, 2023 at 9:47pm</td>
                          <td>812-682-1588</td>
                          <td>$250.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerTen" />
                              <label class="form-check-label" for="customerTen"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-10.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Stephanie Morales</a>
                              </div>
                            </div>
                          </td>
                          <td>stephaniemorales@gmail.com</td>

                          <td>22 Feb, 2023 at 9:47pm</td>
                          <td>812-682-1588</td>
                          <td>$250.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
                                    <i class="bi bi-pencil-square me-3"></i>
                                    Edit
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="pe-0">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="customerEleven" />
                              <label class="form-check-label" for="customerEleven"></label>
                            </div>
                          </td>

                          <td>
                            <div class="d-flex align-items-center">
                              <img src="../assets/images/avatar/avatar-11.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                              <div class="ms-2">
                                <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Pasquale Kidd</a>
                              </div>
                            </div>
                          </td>
                          <td>pasqualekidd@rhyta.com</td>

                          <td>22 Feb, 2023 at 9:47pm</td>
                          <td>336-396-0658</td>
                          <td>$159.00</td>

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
                                  <a class="dropdown-item" href="customers-edits.html">
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

                  <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                    <span>Showing 1 to 8 of 12 entries</span>
                    <nav class="mt-2 mt-md-0">
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