<?php
session_start();
include 'ketnoi.php';
$id_user = $_SESSION['id_user'];
$mamathang = $_GET['mamathang'];
$sql = "DELETE FROM giohang WHERE id_user = $id_user AND mamathang = $mamathang";
mysqli_query($conn, $sql);
header("Location: giohang.php");
exit;
?>
