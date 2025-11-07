<?php
session_start();
include 'ketnoi.php';
$id_user = $_SESSION['id_user'];
$mamathang = $_GET['mamathang'];
$action = $_GET['action'];

if ($action == 'cong') {
    $sql = "UPDATE giohang SET soluong = soluong + 1 WHERE id_user = $id_user AND mamathang = $mamathang";
} elseif ($action == 'tru') {
    $sql = "UPDATE giohang SET soluong = GREATEST(soluong - 1, 1) WHERE id_user = $id_user AND mamathang = $mamathang";
}
mysqli_query($conn, $sql);
header("Location: giohang.php");
exit;
?>
