<?php
 include 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cập nhật sản phẩm</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="login.css">
  <style>
  body {
    background: url('../img/bg.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }
  .khungtrang {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    width: 450px;
    max-width: 90%;
    margin: 50px auto;
    padding: 30px;
    text-align: center;
  }
  .logo img {
    width: 100px;
    margin-bottom: 10px;
  }
  .image-preview {
    max-width: 100%;
    max-height: 200px;
    margin-top: 10px;
    display: none;
  }
  .form-control, .form-select {
    margin-bottom: 15px;
  }
</style>
</head>
<?php
// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên ID truyền vào
$masp = $_GET['id'];
$sql = "SELECT * FROM mathang WHERE mamathang = '$masp'";
$ketqua=mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($ketqua);
// lấy tt đưa vào cbx nhãn hàng
$sql1="Select * FROM thuonghieu";
$kq2=mysqli_query($conn, $sql1);
?>
<body>
  <div class="khungtrang">
    <h4><b>Cập Nhật Sản Phẩm</b></h4>

    <form action="capnhat.php?id=<?php echo $masp; ?>" method="POST">
      
      <!-- Tên sản phẩm -->
      <div class="mb-3">
        <label for="tensp" class="form-label"><i class="bi bi-box-seam-fill"></i> Tên sản phẩm</label>
        <input type="text" class="form-control" id="tensp" name="tensp" value="<?php echo $row['tenmathang'] ?>" required>
      </div>
      
      <!-- List thương hiệu -->
      <div class="mb-3">
        <label for="nhanhieu" class="form-label"><i class="bi bi-tags-fill"></i> Nhãn hiệu</label>
        <select class="form-select" id="nhanhieu" name="nhanhieu" required>
          <option value="" selected disabled>Chọn nhãn hiệu</option>
          <!-- Các tùy chọn nhãn hiệu sẽ được tải từ cơ sở dữ liệu -->
          <?php
             // Truy vấn danh sách thương hiệu
             $sql_th = "SELECT mathuonghieu, tenthuonghieu FROM thuonghieu";
             $kq_th = mysqli_query($conn, $sql_th);

            // Giả sử trong bảng mathang có cột 'mathuonghieu' để biết sản phẩm thuộc thương hiệu nào
            $thuonghieu_hien_tai = $row['mathuonghieu']; // giá trị thương hiệu của sản phẩm đang sửa

            while ($th = mysqli_fetch_assoc($kq_th)) {
        // Nếu thương hiệu hiện tại trùng thì đánh dấu selected
            $selected = ($th['mathuonghieu'] == $thuonghieu_hien_tai) ? 'selected' : '';
            echo "<option value='{$th['mathuonghieu']}' $selected>{$th['tenthuonghieu']}</option>";
      }
    ?>
        </select>
      </div>
      
      <!-- Giá bán -->
      <div class="mb-3">
        <label for="giaban" class="form-label"><i class="bi bi-currency-dollar"></i> Giá bán</label>
        <input type="number" class="form-control" id="giaban" name="giaban" value ="<?php echo $row['giaban']; ?>" required>
      </div>

      <!-- Mô tả sản phẩm -->
      <div class="mb-3">
      <label for="motasp" class="form-label">
         <i class="bi bi-file-text-fill"></i> Mô tả sản phẩm
        </label>
       <textarea class="form-control" id="motasp" name="motasp" rows="5" required><?php echo $row['motasanpham']; ?></textarea>
</div>

      <button type="submit" class="btn btn-primary" name="capnhat">
        <i class="bi bi-plus-circle-fill"></i> Cập Nhật
      </button>

    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>