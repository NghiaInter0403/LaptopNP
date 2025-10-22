<?php
 include 'ketnoi.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>THÊM SẢN PHẨM</title>

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

<body>
  <div class="khungtrang">
    <h4><b>THÊM SẢN PHẨM</b></h4>

    <form action="xulythemsp.php" method="POST" enctype="multipart/form-data">
      <!-- Nút thêm hình ảnh -->
      <div class="mb-3">
        <label for="hinhanh" class="form-label"><i class="bi bi-image-fill"></i> Hình ảnh sản phẩm</label>
        <input type="file" class="form-control" id="hinhanh" name="hinhanh" accept="image/*" required>
      </div>
      
      <!-- Tên sản phẩm -->
      <div class="mb-3">
        <label for="tensp" class="form-label"><i class="bi bi-box-seam-fill"></i> Tên sản phẩm</label>
        <input type="text" class="form-control" id="tensp" name="tensp" placeholder="Nhập tên sản phẩm" required>
      </div>
      
      <!-- List thương hiệu -->
      <div class="mb-3">
        <label for="nhanhieu" class="form-label"><i class="bi bi-tags-fill"></i> Nhãn hiệu</label>
        <select class="form-select" id="nhanhieu" name="nhanhieu" required>
          <option value="" selected disabled>Chọn nhãn hiệu</option>
          <!-- Các tùy chọn nhãn hiệu sẽ được tải từ cơ sở dữ liệu -->
          <?php
            // Truy vấn lấy danh sách nhãn hiệu
            $sql = "SELECT mathuonghieu, tenthuonghieu FROM thuonghieu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Hiển thị từng nhãn hiệu
              while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["mathuonghieu"] . "'>" . $row["tenthuonghieu"] . "</option>";
              }
            } else {
              echo "<option value=''>Không có nhãn hiệu nào</option>";
            }

            // Đóng kết nối
            $conn->close();
          ?>
        </select>
      </div>
      
      <!-- Giá bán -->
      <div class="mb-3">
        <label for="giaban" class="form-label"><i class="bi bi-currency-dollar"></i> Giá bán</label>
        <input type="number" class="form-control" id="giaban" name="giaban" placeholder="Nhập giá bán" min="0" step="0.01" required>
      </div>

      <!-- Mô tả sản phẩm -->
      <div class="mb-3">
        <label for="motasp" class="form-label"><i class="bi bi-file-text-fill"></i> Mô tả sản phẩm</label>
        <textarea class="form-control" id="motasp" name="motasp" rows="5" placeholder="Nhập mô tả sản phẩm" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Thêm sản phẩm
      </button>

    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>