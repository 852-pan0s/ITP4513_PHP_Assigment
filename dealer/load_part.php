<?php
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (isset($_GET["q"])) { //if keyword is provided
  $sql = "SELECT * FROM part WHERE partName LIKE '%{$_GET['q']}%'";
} else {
  $sql = "SELECT * FROM part";
}
$rs = mysqli_query($conn, $sql);
while ($rc = mysqli_fetch_assoc($rs)) {
  $part[] = $rc;
}
echo json_encode($part, JSON_PRETTY_PRINT); // print json string
?>