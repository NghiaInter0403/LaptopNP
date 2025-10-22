<?php
// Kết nối cơ sở dữ liệu
include 'ketnoi.php';
?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản lý sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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
          <li class="nav-item"><a class="nav-link active" href="trangchuad.php">Trang Chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="giohang.php">Giỏ Hàng</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="nhanhieu" role="button" data-bs-toggle="dropdown">
              Nhãn Hiệu
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
          <li class="nav-item"><a class="nav-link" href="quanly.php">Quản Lý Hàng</a></li>
        </ul>

        <form class="d-flex" role="search" method="GET" action="">
          <input class="form-control me-2" type="search" name="tukhoa" placeholder="Tìm kiếm sản phẩm..." 
                 value="<?php if(isset($_GET['tukhoa'])) echo htmlspecialchars($_GET['tukhoa']); ?>">
          <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
  </nav>
<!-- ------ -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10">

        <!-- Hai nút trên cùng -->
        <div class="d-flex justify-content-center mb-4 gap-3">
          <a href="themsp.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
          </a>
          <a href="xemdon.php" class="btn btn-primary">
            <i class="bi bi-receipt"></i> Xem đơn hàng
          </a>
        </div>

        <!-- Bảng sản phẩm -->
        <div class="card shadow-sm">
          <div class="card-header bg-dark text-white text-center">
            <h5 class="mb-0">Danh sách sản phẩm</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center">
                <thead class="table-secondary">
                  <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Hình</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá Bán (VND)</th>
                    <th scope="col">Nhãn hiệu</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // có từ khóa tìm kiếm
                  $tukhoa = '';
                   if (isset($_GET['tukhoa']) && !empty(trim($_GET['tukhoa']))) {
                    $tukhoa = trim($_GET['tukhoa']);
                  }
                  // Truy vấn lấy dữ liệu từ 3 bảng
                  $sql = "SELECT mathang.mamathang, mathang.tenmathang, mathang.giaban, mathang.motasanpham,
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
                      echo '<tr>';
                      echo '<td>' . htmlspecialchars($row['mamathang']) . '</td>';
                      echo '<td><img src="../img/' . htmlspecialchars($row['hinhanh']) . '" alt="Hình SP" style="width:80px; height:80px; object-fit:cover;"></td>';
                      echo '<td>' . htmlspecialchars($row['tenmathang']) . '</td>';
                      echo '<td>' . number_format($row['giaban'],0,',','.'). '</td>';
                      echo '<td>' . htmlspecialchars($row['tenthuonghieu']) . '</td>';
                      echo '<td class="text-start">' . htmlspecialchars($row['motasanpham']) . '</td>';
                      echo '<td><a href="sua_sanpham.php?id=' . $row['mamathang'] . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Sửa</a></td>';
                      echo '<td><a href="xoa_sanpham.php?id=' . $row['mamathang'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc muốn xóa sản phẩm này?\')"><i class="bi bi-trash"></i> Xóa</a></td>';
                      echo '</tr>';
                    }
                  } else {
                    echo "<tr><td colspan='7' class='text-center text-muted'>Chưa có sản phẩm nào</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
