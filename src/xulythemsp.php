<?php
include 'ketnoi.php';
$hinhanh = $_FILES['hinhanh']['name'];
$tensp = $_POST['tensp'];
$thuonghieu = $_POST['nhanhieu'];
$giaban = $_POST['giaban'];
$motasp = $_POST['motasp'];
// Xử lý tải hình ảnh lên thư mục
$targetDir = "../img/";
$targetFile = $targetDir . basename($hinhanh);
if (move_uploaded_file($_FILES['hinhanh']['tmp_name'], $targetFile)) {
    // Chèn dữ liệu vào bảng mathang
    $sql = "INSERT INTO mathang (tenmathang, mathuonghieu, giaban, motasanpham) 
            VALUES ('$tensp', '$thuonghieu', '$giaban', '$motasp')";
    if (mysqli_query($conn, $sql)) {
        $mamathang = mysqli_insert_id($conn);
        // Chèn dữ liệu vào bảng hinh
        $sqlHinh = "INSERT INTO hinh (mamathang, hinhanh) VALUES ('$mamathang', '$hinhanh')";
        if (mysqli_query($conn, $sqlHinh)) {
            echo "<script>alert('Thêm sản phẩm thành công!'); window.location='quanly.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm hình ảnh!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Lỗi khi thêm sản phẩm!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Lỗi khi tải hình ảnh lên!'); window.history back();</script>";
}
?>