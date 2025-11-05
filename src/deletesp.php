<?php
include 'ketnoi.php';
$sp = $_GET['id'];
// Lấy dữ liệu từ biểu mẫu
$sql = "DELETE FROM mathang WHERE mamathang='$sp'";
$kq = mysqli_query($conn, $sql);
if($kq) {
    // Xóa thành công
    header("Location: quanly.php");
    echo "<script>alert('Xóa sản phẩm thành công');</script>";
    exit();
} else {
    // Xóa thất bại
    header("Location: quanly.php");
    echo "<script>alert('Xóa sản phẩm thất bại');</script>";
    exit();
}
?>