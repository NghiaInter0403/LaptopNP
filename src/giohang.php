<?php
include "ketnoi.php";
// khởi tạo session
session_start();
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
  <style>
        .thongtinkhachhang {
  background: rgba(255, 255, 255, 0.95);
  border-radius: 16px;
  padding: 25px 40px;
  margin-top: 50px; /* cách menu 50px */
  margin-bottom: 30px;
  text-align: left;
  color: #333;
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
  transition: all 0.3s ease;
}
.thongtinkhachhang:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
}
.thongtinkhachhang h5 {
  font-weight: 600;
  margin-bottom: 10px;
  color: #0056b3;
}
.thongtinkhachhang label {
  font-weight: 500;
  color: #444;
}
#exampleFormControlTextarea1 {
  border-radius: 8px;
  border: 1px solid #ccc;
  transition: box-shadow 0.2s;
}
#exampleFormControlTextarea1:focus {
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
  border-color: #007bff;
}

    </style>
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
             <i class="bi bi-info-square-fill"></i> Liên Hệ
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="https://www.facebook.com/nghia.phan.76243?locale=vi_VN">Messages</a></li>
              <li><a class="dropdown-item" href="https://www.tiktok.com/@nghiaphanhihihi">TikTok</a></li>
              <li><a class="dropdown-item" href="https://www.instagram.com/nghia6485/">Instargam</a></li>
              
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="quanly.php"><i class="bi bi-kanban-fill"></i> Quản Lý Hàng</a></li>
        </ul>
<!-- thanh tìm kiếm -->
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
          <!-- hiển thị thông tin khách hàng -->
           <div class="thongtinkhachhang">
            <?php
                echo "<h5>Tên khách hàng: " . htmlspecialchars($_SESSION['tendn']) . "</h5>";
                // lệnh php để lấy thông tin user
                $tendn = $_SESSION['tendn'];
                $sql = "SELECT * FROM user WHERE tendangnhap = '$tendn'";
                 $result = mysqli_query($conn, $sql);
                // hiển thị thông tin user nếu có
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<h5>Họ và tên: " . htmlspecialchars($row['hoten']) . "</h5>";
                    echo "<h5>Số điện thoại: " . htmlspecialchars($row['sdt']) . "</h5>";
                } else {
                    echo "<h5>Không tìm thấy thông tin khách hàng.</h5>";
                }
            ?>
            <!-- ô nhập nơi giao hàng -->
               <div class="mb-3">
             <label type="input" for="exampleFormControlTextarea1" class="form-label" name="noigiao" ><h5>Nơi Giao Hàng</h5></label>
             <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
               </div>
            </div>
            <!-- hiển thị sản phẩm đã thêm-->
             <?php
$id_user = $_SESSION['id_user'];

$sql = "SELECT g.*, m.tenmathang, m.giaban 
        FROM giohang g 
        JOIN mathang m ON g.mamathang = m.mamathang
        WHERE g.id_user = $id_user";
$result = mysqli_query($conn, $sql);
?>

<div class="card shadow p-4 mt-4">
  <h4 class="mb-3 text-primary"><i class="bi bi-bag-check-fill"></i> Giỏ hàng của bạn</h4>

  <table class="table table-bordered align-middle text-center">
    <thead class="table-primary">
      <tr>
        <th>Tên mặt hàng</th>
        <th>Giá bán</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $tongtien = 0;
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $thanhtien = $row['giaban'] * $row['soluong'];
          $tongtien += $thanhtien;
          echo "
          <tr>
            <td class='text-start fw-semibold'>{$row['tenmathang']}</td>
            <td>" . number_format($row['giaban'], 0, ',', '.') . "₫</td>
            <td>
              <div class='d-flex justify-content-center align-items-center'>
                <a href='update_soluong.php?mamathang={$row['mamathang']}&action=tru' class='btn btn-sm btn-outline-secondary me-1'>
                  <i class='bi bi-dash'></i>
                </a>
                <span class='fw-bold'>{$row['soluong']}</span>
                <a href='update_soluong.php?mamathang={$row['mamathang']}&action=cong' class='btn btn-sm btn-outline-secondary ms-1'>
                  <i class='bi bi-plus'></i>
                </a>
              </div>
            </td>
            <td class='text-danger fw-semibold'>" . number_format($thanhtien, 0, ',', '.') . "₫</td>
            <td>
              <a href='xoa_giohang.php?mamathang={$row['mamathang']}' class='btn btn-sm btn-danger'>
                <i class='bi bi-trash3-fill'></i> Xóa
              </a>
            </td>
          </tr>";
        }
        echo "
        <tr class='table-light'>
          <td colspan='3' class='text-end fw-bold'>Tổng cộng:</td>
          <td colspan='2' class='text-danger fw-bold'>" . number_format($tongtien, 0, ',', '.') . "₫</td>
        </tr>";
      } else {
        echo "<tr><td colspan='5'>Giỏ hàng trống</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <?php if ($tongtien > 0) { ?>
  <div class="text-end mt-3">
    <a href="dondathang.php" class="btn btn-success btn-lg">
      <i class="bi bi-credit-card"></i> Mua hàng
    </a>
  </div>
  <?php } ?>
</div>
<!-- hết hiển thị sản phẩm đã thêm-->
      </div>
      <div class="col-1"></div>
    </div>
  </div>
  </div>

  <!-- Chân trang -->
  
 <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>