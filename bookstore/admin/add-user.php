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
              <div>
                <h2>Create Customer</h2>
                <!-- breacrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card shadow border-0">
                <div class="card-body d-flex flex-column gap-8 p-7">
                  <div class="d-flex flex-column flex-md-row align-items-center mb-4 file-input-wrapper gap-2">
                    <div>
                      <img class="image avatar avatar-lg rounded-3" src="../assets/images/docs/placeholder-img.jpg" alt="Image" />
                    </div>

                    <div class="file-upload btn btn-light ms-md-4">
                      <input type="file" class="file-input opacity-0" />
                      Upload Photo
                    </div>

                    <span class="ms-2">JPG, GIF or PNG. 1MB Max.</span>
                  </div>
                  <div class="d-flex flex-column gap-4">
                    <h3 class="mb-0 h6">Customer Information</h3>
                    <form class="row g-3 needs-validation" novalidate>
                      <div class="col-lg-6 col-12">
                        <div>
                          <!-- input -->
                          <label for="creatCustomerName" class="form-label">
                            Name
                            <span class="text-danger">*</span>
                          </label>
                          <input type="text" class="form-control" id="creatCustomerName" placeholder="Customer Name" required />
                          <div class="invalid-feedback">Please enter customer name</div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div>
                          <!-- input -->
                          <label for="creatCustomerEmail" class="form-label">
                            Email
                            <span class="text-danger">*</span>
                          </label>
                          <input type="email" class="form-control" id="creatCustomerEmail" placeholder="Email Address" required />
                          <div class="invalid-feedback">Please enter email</div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div>
                          <!-- input -->
                          <label for="creatCustomerPhone" class="form-label">Phone</label>
                          <input type="text" class="form-control" id="creatCustomerPhone" placeholder="Number" required />
                          <div class="invalid-feedback">Please enter phone</div>
                        </div>
                      </div>

                      <div class="col-lg-6 col-12">
                        <label class="form-label" for="creatCustomerDate">Birthday</label>
                        <input type="text" class="form-control flatpickr" id="creatCustomerDate" placeholder="dd/mm/yyyy" required />
                        <div class="invalid-feedback">Please enter date</div>
                      </div>
                      <div>
                        <div class="col-12 mt-3">
                          <div class="d-flex flex-column flex-md-row gap-2">
                            <button class="btn btn-primary" type="submit">Create New Customer</button>
                            <button class="btn btn-secondary" type="submit">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
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