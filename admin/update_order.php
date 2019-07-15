<?php
session_start();
//Database connection part
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);

//check if the user loggeed in the system
if (!isset($_SESSION["email"])) {//if the admin does not log in before
  header("location:login.php");//redirect to login page
} else {
  if (isset($_GET['id'])) {//if no order id provides
    extract($_GET);
    $sql = "SELECT * FROM orders WHERE orderID = $id"; //find the order
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_array($rs);
    if ($rc["status"] == "4" || ($rc["status"] != "1" && $status == "2")) {//4=cancel, cancelled order can't be modified, 1=in processing, 2=delivery, only in processing order can change to delivery order
//      echo "Fail";
      header("location:detail.php?orderID=$id&fail");//redirect to order detail page and show the fail message
    } else if ($status == "4") {
      //cancel order
      $sql = "UPDATE orders SET status = $status WHERE orderID = $id";
      mysqli_query($conn, $sql);
      //return the stock qty
      if($rc["status"]==2){
        //add the stock qty back
        $sql = "SELECT * FROM orderpart WHERE orderID = $id";
        $rs = mysqli_query($conn, $sql);
        while ($rc = mysqli_fetch_assoc($rs)) {
          extract($rc);
          $sql = "UPDATE part set stockQuantity = stockQuantity+$quantity WHERE partNumber = $partNumber";
          mysqli_query($conn, $sql);
        }
      }
      header("location:detail.php?orderID=$id&ok");//redirect to order detail page and show the ok message
    } else { //delivery order
      //find all the order part information and check the stock of them.
      $sql = "SELECT * FROM orderpart WHERE orderID = $id";
      $rs = mysqli_query($conn, $sql);
      //checking the stock is enough for delivery
      /*
      while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
        $sql = "SELECT * FROM part WHERE partNumber = $partNumber";
        $exec = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($exec);
        if ($result["stockQuantity"] < $quantity) { //if the part stock quantity is less than the quantity of ordered part
          header("location:detail.php?orderID=$id&out_of_stock={$result['partName']}");//redirect to order detail page and show the ok message
          die(); //stop this php page
        }
      }*/

      //deduct the stock qty
      /*
      $sql = "SELECT * FROM orderpart WHERE orderID = $id";
      $rs = mysqli_query($conn, $sql);
      while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);
        $sql = "UPDATE part set stockQuantity = stockQuantity-$quantity WHERE partNumber = $partNumber";
     //   echo "$sql<br>";
        mysqli_query($conn, $sql);
      }*/

      //Change the order status to delivery
      $sql = "UPDATE orders SET status = $status WHERE orderID = $id";
      mysqli_query($conn, $sql);
      header("location:detail.php?orderID=$id&ok");//redirect to order detail page and show the ok message
    }
  }
}
mysqli_free_result($rs); //free the result
mysqli_close($conn); //close the connect
?>