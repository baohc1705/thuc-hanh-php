<?php
include('config/config.php');
session_start();

$root = realpath(__DIR__ . '/lab'); 
$baseUrl = 'lab';

$path = isset($_GET['dir']) ? $_GET['dir'] : '.';

$realPath = realpath($root . '/' . $path);


if ($realPath === false || strpos($realPath, $root) !== 0) {
    die("Access denied.");
}


$files = scandir($realPath);


function formatSize($bytes) {
    if ($bytes < 1024) return $bytes . " B";
    elseif ($bytes < 1048576) return round($bytes / 1024, 1) . " KB";
    return round($bytes / 1048576, 1) . " MB";
}

function formatDate($time) {
    return date("Y-m-d H:i", $time);
}

$dirs = [];
$fileList = [];

foreach ($files as $file) {
    if ($file === "." || $file === "..") continue;
    
    $filePath = $realPath . "/" . $file;
    $url = ($path === ".") ? $file : $path . "/" . $file;
    
    $isDir = is_dir($filePath);
    $mtime = filemtime($filePath);
    $size = $isDir ? "-" : formatSize(filesize($filePath));
    
    // Xử lý link
    if ($isDir) {
        $href = "?dir=" . htmlspecialchars($url);
        $dirs[] = [
            'name' => $file,
            'href' => $href,
            'modified' => formatDate($mtime),
            'size' => $size
        ];
    } else {
        // Chỉ hiển thị file PHP
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            $fileUrl = $baseUrl . "/" . htmlspecialchars($url);
            $fileUrl = ltrim($fileUrl, './');
            $fileList[] = [
                'name' => $file,
                'href' => $fileUrl,
                'modified' => formatDate($mtime),
                'size' => $size
            ];
        }
    }
}


usort($dirs, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});
usort($fileList, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

$parentDir = '';
if ($path !== ".") {
    $parent = dirname($path);
    $parentDir = $parent === "." ? "" : "?dir=" . htmlspecialchars($parent);
}

$breadcrumbs = [];
if ($path !== ".") {
    $parts = explode('/', $path);
    $currentPath = '';
    foreach ($parts as $part) {
        $currentPath = $currentPath ? $currentPath . '/' . $part : $part;
        $breadcrumbs[] = [
            'name' => $part,
            'path' => $currentPath
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lab Thực Hành - Unibook</title>
  <?php include('include/lib.php') ?>
</head>

<body>
  <?php include('header.php') ?>

  <main>
    <section class="py-8 py-lg-11">
      <div class="container">
        <!-- Header -->
        <div class="row mb-5">
          <div class="col-12">
            <h1 class="mb-2 fw-bold">Lab Thực Hành PHP</h1>
            <p class="text-muted mb-0">Index of /lab<?= $path !== "." ? "/" . htmlspecialchars($path) : "" ?></p>
          </div>
        </div>

        <!-- Breadcrumb -->
        <?php if (!empty($breadcrumbs)): ?>
        <div class="row mb-4">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="labthuchanh.php" class="text-decoration-none">Lab</a>
                </li>
                <?php 
                $breadcrumbPath = '';
                foreach ($breadcrumbs as $index => $crumb): 
                  $breadcrumbPath = $breadcrumbPath ? $breadcrumbPath . '/' . $crumb['name'] : $crumb['name'];
                ?>
                  <li class="breadcrumb-item <?= $index === count($breadcrumbs) - 1 ? 'active' : '' ?>" 
                      <?= $index === count($breadcrumbs) - 1 ? 'aria-current="page"' : '' ?>>
                    <?php if ($index === count($breadcrumbs) - 1): ?>
                      <?= htmlspecialchars($crumb['name']) ?>
                    <?php else: ?>
                      <a href="?dir=<?= htmlspecialchars($breadcrumbPath) ?>" class="text-decoration-none">
                        <?= htmlspecialchars($crumb['name']) ?>
                      </a>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ol>
            </nav>
          </div>
        </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <h5 class="mb-0">
                  <i class="bi bi-folder-fill me-2"></i>
                  Directory Listing
                </h5>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover table-borderless mb-0">
                    <thead class="bg-light">
                      <tr>
                        <th scope="col" class="ps-4">Name</th>
                        <th scope="col">Last Modified</th>
                        <th scope="col" class="text-end pe-4">Size</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Parent Directory -->
                      <?php if ($path !== "."): ?>
                      <tr>
                        <td class="ps-4">
                          <a href="<?= $parentDir ?>" class="text-decoration-none d-flex align-items-center">
                            <i class="bi bi-arrow-left-circle me-2 text-primary"></i>
                            <i class="bi bi-folder me-2 text-warning"></i>
                            <strong>Parent Directory</strong>
                          </a>
                        </td>
                        <td>-</td>
                        <td class="text-end pe-4">-</td>
                      </tr>
                      <?php endif; ?>
                      
                      <?php foreach ($dirs as $dir): ?>
                      <tr>
                        <td class="ps-4">
                          <a href="<?= $dir['href'] ?>" class="text-decoration-none d-flex align-items-center">
                            <i class="bi bi-folder-fill me-2 text-warning"></i>
                            <strong><?= htmlspecialchars($dir['name']) ?>/</strong>
                          </a>
                        </td>
                        <td><?= $dir['modified'] ?></td>
                        <td class="text-end pe-4">-</td>
                      </tr>
                      <?php endforeach; ?>
                      
                      <!-- Files -->
                      <?php foreach ($fileList as $file): ?>
                      <tr>
                        <td class="ps-4">
                          <a href="<?= $file['href'] ?>" target="_blank" class="text-decoration-none d-flex align-items-center">
                            <i class="bi bi-file-earmark-code me-2 text-primary"></i>
                            <?= htmlspecialchars($file['name']) ?>
                          </a>
                        </td>
                        <td><?= $file['modified'] ?></td>
                        <td class="text-end pe-4"><?= $file['size'] ?></td>
                      </tr>
                      <?php endforeach; ?>
                      
                      <?php if (empty($dirs) && empty($fileList)): ?>
                      <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                          <i class="bi bi-inbox me-2"></i>
                          Thư mục trống
                        </td>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include('footer.php') ?>
  
  <!-- Javascript-->
  <!-- Libs JS -->
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
</html>
