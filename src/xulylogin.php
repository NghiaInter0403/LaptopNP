<?php
include 'ketnoi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tendn = $_POST['tendn'];
    $matkhau = $_POST['matkhau'];
// kiểm tra ô trống
if (
        empty($tendn) || empty($matkhau)
    ) {
        echo "<script>alert('Không được để trống ô nào!'); window.history.back();</script>";
        exit();
    }
    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM user WHERE tendangnhap = '$tendn' AND matkhau = '$matkhau'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $row['id'];
        $_SESSION['tendn'] = $row['tendangnhap'];
        $_SESSION['role'] = $row['role'];

        // Kiểm tra role để chuyển trang
        if ($row['role'] == 'admin') {
            echo "<script>alert('Bạn đã truy cập với tư cách admin!');  window.location='trangchuad.php';</script>";
            exit();
        } elseif ($row['role'] == 'user') {
            echo "<script>alert('Bạn đã truy cập với tư cách khách hàng!');  window.location='trangchu.php';</script>";
            exit();
        } else {
            echo "<script>alert('Không xác định được quyền truy cập!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Truy cập không hợp lệ!'); window.location='login.html';</script>";
}
?>
