<?php
//db connection
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
//if the search keyword exists
if (isset($_GET["q"])) {
  $sql = "SELECT orderID, o.dealerID, name, orderDate,o.deliveryAddress,status FROM orders o, dealer d WHERE o.dealerID = d.dealerID AND orderID LIKE '%{$_GET['q']}%' ORDER BY orderID DESC";
} else { // else show all the order
  $sql = "SELECT orderID, o.dealerID, name, orderDate,o.deliveryAddress,status FROM orders o, dealer d WHERE o.dealerID = d.dealerID ORDER BY orderID DESC";
}
$rs = mysqli_query($conn, $sql);
while ($rc = mysqli_fetch_assoc($rs)) {
  $part[] = $rc;
}
//show json code
echo json_encode($part, JSON_PRETTY_PRINT);
?>