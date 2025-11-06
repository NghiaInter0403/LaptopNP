<?php
include "ketnoi.php";

// Lấy từ khóa nếu có
$tukhoa = '';
if (isset($_GET['tukhoa']) && trim($_GET['tukhoa']) !== '') {
    $tukhoa = trim($_GET['tukhoa']);
}

// Lấy mã sản phẩm
$masp = '';
if (isset($_GET['masanpham']) && trim($_GET['masanpham']) !== '') {
    $masp = trim($_GET['masanpham']);
}

// Câu truy vấn
$sql = "SELECT mathang.mamathang, mathang.tenmathang, mathang.motasanpham, mathang.giaban, 
               thuonghieu.tenthuonghieu, hinh.hinhanh
        FROM mathang
        JOIN hinh ON mathang.mamathang = hinh.mamathang
        JOIN thuonghieu ON mathang.mathuonghieu = thuonghieu.mathuonghieu";

// Nếu tìm kiếm
if ($tukhoa !== '') {
    $tk_esc = mysqli_real_escape_string($conn, $tukhoa);
    $sql .= " WHERE mathang.tenmathang LIKE '%$tk_esc%'";
}
// Nếu có mã sản phẩm cụ thể → chỉ lấy 1
elseif ($masp !== '') {
    $masp_esc = mysqli_real_escape_string($conn, $masp);
    $sql .= " WHERE mathang.mamathang = '$masp_esc' LIMIT 1";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="trangchu.css">
    <style>
    .chantrang {
  background-color: #00000051;
  position: fixed;
  bottom: 0;
  width: 100%;
  color: white;
  text-align: center;
}
    </style>
</head>
<body>
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
<div class="container mt-4">
<?php
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>
    <div class="row">
        <div class="col-md-5">
            <img src="../img/<?php echo htmlspecialchars($row['hinhanh']); ?> " 
                 class="img-fluid rounded shadow-sm" style="height: 500px; width: auto;"
                 alt="<?php echo htmlspecialchars($row['tenmathang']); ?>">
        </div>
        <div class="col-md-7" style="margin-top: 20px; font-size: 30px;">
            <h3 class="text" style=" color: #e98b07ff; font-size: 50px"><?php echo htmlspecialchars($row['tenmathang']); ?></h3>
            <p class="text-white" style="">Mã sản phẩm: <?php echo htmlspecialchars($row['mamathang']); ?></p>
            <p class="text-white" style="">Thương hiệu: <?php echo htmlspecialchars($row['tenthuonghieu']); ?></p>
            <h4 class="text-danger" style="font-size: 40px;"><?php echo number_format($row['giaban'], 0, ',', '.'); ?> VND</h4>
            <p style="color: white">Cấu Hình: <?php echo nl2br(htmlspecialchars($row['motasanpham'] ?? 'Chưa có mô tả.')); ?></p>
            <a href="giohang.php?masanpham=<?php echo urlencode($row['mamathang']); ?>" class="btn btn-success">
                <i class="bi bi-cart-plus"></i> Thêm vào giỏ
            </a>
        </div>
    </div>
    <?php
} else {
    echo "<p class='text-center text-muted'>Không tìm thấy sản phẩm.</p>";
}
?>
</div>

<footer class="chantrang">
  <p>Sản phẩm của sinh viên CTEC - Trường Cao Đẳng Kinh Tế Kỹ Thuật Cần Thơ</p>
  <p>Người thực hiện: Phan Hiếu Nghĩa MSSV: 23CTHA0372</p>
  <p>Liên hệ: 0352755926 - phanhieunghia13052019@gmail.com</p>
</footer>

</body>
</html>
