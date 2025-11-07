<?php
session_start();
include 'ketnoi.php'; // kết nối MySQL

// Giả sử id_user đã lưu trong session khi đăng nhập
$id_user = $_SESSION['id_user'];
$mamathang = $_GET['mamathang'];
$soluong = 1;

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
$check_sql = "SELECT * FROM giohang WHERE id_user = $id_user AND mamathang = $mamathang";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Nếu đã có thì tăng số lượng
    $update_sql = "UPDATE giohang 
                   SET soluong = soluong + $soluong 
                   WHERE id_user = $id_user AND mamathang = $mamathang";
    mysqli_query($conn, $update_sql);
} else {
    // Nếu chưa có thì thêm mới
    $insert_sql = "INSERT INTO giohang (id_user, mamathang, soluong) 
                   VALUES ($id_user, $mamathang, $soluong)";
    mysqli_query($conn, $insert_sql);
}
// Sau khi thêm xong, quay lại trang giỏ hàng
header("Location: giohang.php");
exit;
?>
