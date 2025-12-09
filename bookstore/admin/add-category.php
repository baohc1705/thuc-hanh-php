<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from freshcart.codescandy.com/dashboard/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2024 06:08:49 GMT -->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta content="Codescandy" name="author" />
    <title>Dashboard eCommerce HTML Template - FreshCart</title>
    <!-- Favicon icon-->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="../images/favicon/favicon.ico"
    />

    <!-- Libs CSS -->
    <link
      href="../libs/bootstrap-icons/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link
      href="../libs/feather-webfont/dist/feather-icons.css"
      rel="stylesheet"
    />
    <link
      href="../libs/simplebar/dist/simplebar.min.css"
      rel="stylesheet"
    />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../css/theme.min.css" />
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
    <!-- main -->
    <div>
      <!-- navbar -->
      <?php include('header.php') ?>

      <div class="main-wrapper">

        <?php include('sidebar.php') ?>
<main class="main-content-wrapper">
            <!-- container -->
            <div class="container">
               <!-- row -->
               <div class="row mb-8">
                  <div class="col-md-12">
                     <div class="d-md-flex justify-content-between align-items-center">
                        <!-- page header -->
                        <div>
                           <h2>Add New Category</h2>
                           <!-- breacrumb -->
                           <nav aria-label="breadcrumb">
                              <ol class="breadcrumb mb-0">
                                 <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                 <li class="breadcrumb-item"><a href="#" class="text-inherit">Categories</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                              </ol>
                           </nav>
                        </div>
                        <div>
                           <a href="categories.html" class="btn btn-light">Back to Categories</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-12">
                     <!-- card -->
                     <div class="card mb-6 shadow border-0">
                        <!-- card body -->
                        <div class="card-body p-6">
                           <h4 class="mb-5 h5">Category Image</h4>
                           <div class="mb-4 d-flex">
                              <div class="position-relative">
                                 <img class="image icon-shape icon-xxxl bg-light rounded-4" src="../assets/images/icons/bakery.svg" alt="Image" />

                                 <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                                    <input type="file" class="file-input" />
                                    <span class="icon-shape icon-sm rounded-circle bg-white">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill text-muted" viewBox="0 0 16 16">
                                          <path
                                             d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                       </svg>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <h4 class="mb-4 h5 mt-5">Category Information</h4>

                           <div class="row">
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Category Name</label>
                                 <input type="text" class="form-control" placeholder="Category Name" required />
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Slug</label>
                                 <input type="text" class="form-control" placeholder="Slug" required />
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Parent Category</label>
                                 <select class="form-select">
                                    <option selected>Category Name</option>
                                    <option value="Dairy, Bread & Eggs">Dairy, Bread & Eggs</option>
                                    <option value="Snacks & Munchies">Snacks & Munchies</option>
                                    <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                 </select>
                              </div>
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Date</label>
                                 <input type="text" class="form-control flatpickr" placeholder="Select Date" />
                              </div>

                              <div></div>
                              <!-- input -->
                              <div class="mb-3 col-lg-12">
                                 <label class="form-label">Descriptions</label>

                                 <div class="py-8" id="editor"></div>
                              </div>

                              <!-- input -->
                              <div class="mb-3 col-lg-12">
                                 <label class="form-label" id="productSKU">Status</label>
                                 <br />
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked />
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                 </div>
                                 <!-- input -->
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                                    <label class="form-check-label" for="inlineRadio2">Disabled</label>
                                 </div>
                                 <!-- input -->
                              </div>
                              <div class="mb-3 col-lg-12 mt-5">
                                 <h4 class="mb-4 h5">Meta Data</h4>
                                 <!-- input -->
                                 <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" placeholder="Title" />
                                 </div>

                                 <!-- input -->
                                 <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Meta Description"></textarea>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <a href="#" class="btn btn-primary">Create Product</a>
                                 <a href="#" class="btn btn-secondary ms-2">Save</a>
                              </div>
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
