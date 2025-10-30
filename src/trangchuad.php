<?php
include "ketnoi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="trangchu.css">
</head>
<body>
    <!-- Thanh điều hướng -->
  <nav class="navbar navbar-expand-lg navbar-dark nenxanh">
    <div class="container-fluid">
        <div class="logo">
            <a class="navbar-brand" href="#">
                <img src="../img/logoNPtrang.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            </a>
        </div>
      <a class="navbar-brand" href="#"><b>LAPTOP NP</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuchinh">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuchinh">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="trangchuad.php"><i class="bi bi-house-door-fill"></i> Trang Chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="giohang.php"><i class="bi bi-bag-plus-fill"></i> Giỏ Hàng</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="nhanhieu" role="button" data-bs-toggle="dropdown">
             <i class="bi bi-info-square-fill"></i> Nhãn Hiệu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="lenovo.php">Lenovo</a></li>
              <li><a class="dropdown-item" href="Dell.php">Dell</a></li>
              <li><a class="dropdown-item" href="Macbook.php">Macbook</a></li>
              <li><a class="dropdown-item" href="Asus.php">Asus</a></li>
              <li><a class="dropdown-item" href="Acer.php">Acer</a></li>
              <li><a class="dropdown-item" href="HP.php">HP</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="quanly.php"><i class="bi bi-kanban-fill"></i> Quản Lý Hàng</a></li>
        </ul>

        <form class="d-flex" role="search" method="GET" action="">
          <input class="form-control me-2" type="search" name="tukhoa" placeholder="Tìm kiếm sản phẩm..." 
                 value="<?php if(isset($_GET['tukhoa'])) echo htmlspecialchars($_GET['tukhoa']); ?>">
          <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Nội dung trang -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
        <div class="hanghoa-container">
          <div class="row">
            <!-- Sản phẩm mẫu -->
            <?php
             // Lấy từ khóa tìm kiếm
            $tukhoa = '';
            if (isset($_GET['tukhoa']) && !empty(trim($_GET['tukhoa']))) {
              $tukhoa = trim($_GET['tukhoa']);
            }

            // Truy vấn sản phẩm
            $sql = "SELECT mathang.mamathang, mathang.tenmathang, mathang.giaban, 
                           thuonghieu.tenthuonghieu, hinh.hinhanh
                    FROM mathang
                    JOIN hinh ON mathang.mamathang = hinh.mamathang
                    JOIN thuonghieu ON mathang.mathuonghieu = thuonghieu.mathuonghieu";

            if (!empty($tukhoa)) {
              $sql .= " WHERE mathang.tenmathang LIKE '%" . $conn->real_escape_string($tukhoa) . "%'";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-3 mb-4">
                  <div class="card thehanghoa shadow-sm">
                    <img src="../img/' . htmlspecialchars($row['hinhanh']) . '" class="card-img-top" alt="' . htmlspecialchars($row['tenmathang']) . '" style="height:200px; object-fit:cover;">
                    <div class="card-body text-center">
                      <h5 class="tenhanghoa">' . htmlspecialchars($row['tenmathang']) . '</h5>
                      <p class="text-muted mb-1">' . htmlspecialchars($row['tenthuonghieu']) . '</p>
                      <p class="giaban text-danger fw-bold">' . number_format($row['giaban'],0,',','.') . '₫</p>
                      <div class="nut-group d-flex justify-content-center gap-2">
                        <button class="btn btn-outline-primary btn-sm"><i class="bi bi-cart-plus"></i> Thêm Giỏ</button>
                        <button class="btn btn-primary btn-sm"> chi tiết</button>
                      </div>
                    </div>
                  </div>
                </div>';
              }
            } else {
              echo "<p class='text-center text-muted'>Không tìm thấy sản phẩm nào.</p>";
            }
            ?>
<!--hết hàng hóa -->
          </div> <!-- end row -->
        </div>
      </div>
      <div class="col-1"></div>
    </div>
  </div>

  <!-- Chân trang -->
  <footer class="chantrang text-center text-light py-3">
    <p>Sản phẩm của sinh viên CTEC "Trường Cao Đẳng Kinh Tế Kỹ Thuật Cần Thơ"</p>
    <p>Người thực hiện: Phan Hiếu Nghĩa MSSV: 23CTHA0372</p>
    <p>Liên hệ: 0352755926 Email: phanhieunghia13052019@gmail.com</p>
  </footer>
 <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>