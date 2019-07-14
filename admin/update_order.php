<?php
session_start();
//Database connection part
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!isset($_SESSION["email"])) {
  header("location:login.php");
} else {
  if (isset($_GET['id'])) {
    extract($_GET);
    $sql = "SELECT * FROM orders WHERE orderID = $id";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_array($rs);
    if ($rc["status"] == "4" || ($rc["status"] != "1" && $status == "2")) {
      echo "Fail";
      header("location:detail.php?orderID=$id&fail");
    } else {
      $sql = "UPDATE orders SET status = $status WHERE orderID = $id";
      mysqli_query($conn,$sql);
      header("location:detail.php?orderID=$id&ok");
    }
  }
}
mysqli_free_result($rs);
mysqli_close($conn);
?>