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
  $sql = "SELECT * FROM administrator WHERE email = '{$_SESSION['email']}'";
  $rs = mysqli_query($conn, $sql); // Get dealer information
  $rc = mysqli_fetch_assoc($rs); // Take the first row
  extract($rc);
}
if (isset($_POST["update"])) {
  extract($_POST);
  $stockStatus = $stockStatus == "Available" ? 1 : 2;
  $sql = "UPDATE part SET partNumber = $partNumber, partName = '$partName', email = '$email', stockQuantity = $stockQuantity, stockPrice = $stockPrice, stockStatus = $stockStatus WHERE partNumber = $partNumber";
  mysqli_query($conn, $sql);
  header("location:part.php?id=$partNumber&ok");
}
if (isset($_POST["new"])) {
  extract($_POST);
  $stockStatus = $stockStatus == "Available" ? 1 : 2;
  $sql = "INSERT INTO part VALUES($partNumber,'$email','$partName',$stockQuantity,$stockPrice,$stockStatus);";
  mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) < 1) {
    header("location:new_part.php?fail&partName=$partName&stockQuantity=$stockQuantity&stockPrice=$stockPrice&stockStatus=$stockStatus");
  } else {
    header("location:new_part.php?ok");
  }
}
mysqli_free_result($rs);
mysqli_close($conn);
?>