<?php
include 'ketnoi.php';
$sp = $_GET['id'];
$tensp = $_POST['tensp'];
$nhanhieu = $_POST['nhanhieu'];
$giaban = $_POST['giaban'];
$motasp = $_POST['motasp'];
// Câu lệnh cập nhật
$sql = "UPDATE mathang SET tenmathang='$tensp', mathuonghieu='$nhanhieu', giaban='$giaban', motasanpham='$motasp' WHERE mamathang='$sp'";
$kq = mysqli_query($conn, $sql);
if ($kq) {
    // Cập nhật thành công
    header("Location: quanly.php");
    echo "<script>alert('Cập nhật sản phẩm thành công');</script>";
    exit();
} else {
    // Cập nhật thất bại
    header("Location: quanly.php");
    echo "<script>alert('Cập nhật sản phẩm thất bại');</script>";
    exit();
}
?>