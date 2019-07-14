<?php
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (isset($_GET["q"])) {
  $sql = "SELECT orderID, o.dealerID, name, orderDate,o.deliveryAddress,status FROM orders o, dealer d WHERE o.dealerID = d.dealerID AND orderID LIKE '%{$_GET['q']}%'";
} else {
  $sql = "SELECT orderID, o.dealerID, name, orderDate,o.deliveryAddress,status FROM orders o, dealer d WHERE o.dealerID = d.dealerID";
}
$rs = mysqli_query($conn, $sql);
while ($rc = mysqli_fetch_assoc($rs)) {
  $part[] = $rc;
}
echo json_encode($part, JSON_PRETTY_PRINT);
?>