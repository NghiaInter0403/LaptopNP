<?php
include 'ketnoi.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $tendn = $_POST['tendn'];
    $ngaysinh = $_POST['ngaysinh'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $matkhau = $_POST['matkhau'];

    // Kiểm tra tài khoản đã tồn tại hay chưa
    $sql_check = "SELECT * FROM user WHERE tendangnhap = '$tendn'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Tên đăng nhập đã tồn tại! Vui lòng chọn tên khác.'); window.history.back();</script>";
        exit();
    }
    // Nếu chưa tồn tại thì thêm tài khoản mới
    $sql_insert = "INSERT INTO user (hoten, tendangnhap, ngaysinh, sdt, diachi, matkhau)
                   VALUES ('$hoten', '$tendn', '$ngaysinh', '$sdt', '$diachi', '$matkhau')";

    if (mysqli_query($conn, $sql_insert)) {
        echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location='login.html';</script>";
    } else {
        echo "<script>alert('Đăng ký thất bại! Vui lòng thử lại.'); window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Truy cập không hợp lệ!'); window.location='dangki.html';</script>";
}
?>
