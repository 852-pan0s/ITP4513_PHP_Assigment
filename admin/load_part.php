<?php
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (isset($_GET["q"])) {
  $sql = "SELECT * FROM part WHERE partNumber LIKE '%{$_GET['q']}%' ORDER BY partNumber DESC";
} else {
  $sql = "SELECT * FROM part ORDER BY partNumber DESC";
}
$rs = mysqli_query($conn, $sql);
while ($rc = mysqli_fetch_assoc($rs)) {
  $part[] = $rc;
}
echo json_encode($part, JSON_PRETTY_PRINT);
?>