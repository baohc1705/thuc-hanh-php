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

        <!-- main wrapper -->
        <main class="main-content-wrapper">
            <!-- container -->
            <div class="container">
               <!-- row -->
               <div class="row mb-8">
                  <div class="col-md-12">
                     <div class="d-md-flex justify-content-between align-items-center">
                        <!-- page header -->
                        <div>
                           <h2>Add New Product</h2>
                           <!-- breacrumb -->
                           <nav aria-label="breadcrumb">
                              <ol class="breadcrumb mb-0">
                                 <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                 <li class="breadcrumb-item"><a href="#" class="text-inherit">Products</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                              </ol>
                           </nav>
                        </div>
                        <!-- button -->
                        <div>
                           <a href="products.html" class="btn btn-light">Back to Product</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <div class="row">
                  <div class="col-lg-8 col-12">
                     <!-- card -->
                     <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                           <h4 class="mb-4 h5">Product Information</h4>
                           <div class="row">
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Title</label>
                                 <input type="text" class="form-control" placeholder="Product Name" required />
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Product Category</label>
                                 <select class="form-select">
                                    <option selected>Product Category</option>
                                    <option value="Dairy, Bread & Eggs">Dairy, Bread & Eggs</option>
                                    <option value="Snacks & Munchies">Snacks & Munchies</option>
                                    <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                 </select>
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Weight</label>
                                 <input type="text" class="form-control" placeholder="Weight" required />
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Units</label>
                                 <select class="form-select">
                                    <option selected>Select Units</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                 </select>
                              </div>
                              <div>
                                 <div class="mb-3 col-lg-12 mt-5">
                                    <!-- heading -->
                                    <h4 class="mb-3 h5">Product Images</h4>

                                    <!-- input -->
                                    <div id="my-dropzone" class="dropzone mt-4 border-dashed rounded-2 min-h-0"></div>
                                 </div>
                              </div>
                              <!-- input -->
                              <div class="mb-3 col-lg-12 mt-5">
                                 <h4 class="mb-3 h5">Product Descriptions</h4>
                                 <div class="py-8" id="editor"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-12">
                     <!-- card -->
                     <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                           <!-- input -->
                           <div class="form-check form-switch mb-4">
                              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" checked />
                              <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                           </div>
                           <!-- input -->
                           <div>
                              <div class="mb-3">
                                 <label class="form-label">Product Code</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Title" />
                              </div>
                              <!-- input -->
                              <div class="mb-3">
                                 <label class="form-label">Product SKU</label>
                                 <input type="text" class="form-control" placeholder="Enter Product Title" />
                              </div>
                              <!-- input -->
                              <div class="mb-3">
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
                           </div>
                        </div>
                     </div>
                     <!-- card -->
                     <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                           <h4 class="mb-4 h5">Product Price</h4>
                           <!-- input -->
                           <div class="mb-3">
                              <label class="form-label">Regular Price</label>
                              <input type="text" class="form-control" placeholder="$0.00" />
                           </div>
                           <!-- input -->
                           <div class="mb-3">
                              <label class="form-label">Sale Price</label>
                              <input type="text" class="form-control" placeholder="$0.00" />
                           </div>
                        </div>
                     </div>
                     <!-- card -->
                     <div class="card mb-6 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
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
                     </div>
                     <!-- button -->
                     <div class="d-grid">
                        <a href="#" class="btn btn-primary">Create Product</a>
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
