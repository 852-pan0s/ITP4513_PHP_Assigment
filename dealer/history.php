<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="./css/mdc_typography.css">

    <!--top / menu bar lib-->
    <link rel="stylesheet" href="./css/index.css">
    <!--  <script src="./js/index.js"></script>-->

    <!--mdc optional-->
    <!--  <link rel="stylesheet" href="./css/shopping.css">-->
    <!--  <script src="./js/shopping.js"></script>-->
    <!--  <link rel="stylesheet" href="./css/mdc_checkbox.css">-->
    <!--  <script src="./js/mdc_checkbox.js"></script>-->

    <!--  semantic-ui library-->
    <link rel="stylesheet" type="text/css" href="./node_modules/semantic-ui/dist/semantic.min.css">
    <script src="./node_modules/semantic-ui/dist/semantic.min.js"></script>

    <!-- material-design life lib-->
    <link rel="stylesheet" href="./node_modules/material-design-lite/material.min.css">
    <script src="./node_modules/material-design-lite/material.min.js"></script>

    <!--  my css or js-->
    <link rel="stylesheet" href="./css/mycss.css">
    <script src="./js/myjs.js"></script>


    <script>
        $(document).ready(function () {
            $('#btn_search').on('click', function () {
                var search = $('#search').val();
                window.location.assign(`<?php echo $_SERVER["PHP_SELF"] ?>?q=${search}`); //add part to the shopping cart
            })
        });
    </script>
</head>

<body class="mdc-typography">
<?php
session_start();
//Database connection part
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$search = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!isset($_SESSION["dealerID"])) { //if the dealer does not log in before
  header("location:login.php");//redirect to login page
}
if (isset($_GET['cancel_order'])) { //if the dealer wants to cancel the order
  $id = $_GET['cancel_order']; //get order id which the dealer wants to cancel
  $cStatus = $_GET['status'];
  $sql = "SELECT * FROM orders WHERE orderID = $id";
  $rs = mysqli_query($conn, $sql);
  $rc = mysqli_fetch_array($rs);
  if (($rc["status"] == "1" && $cStatus == "4")) { //1 = in processing , cStatus=change status, only in processing order can be canceled
    $sql = "UPDATE orders SET status = 4 WHERE orderID = {$_GET['cancel_order']}";
    mysqli_query($conn,$sql);
    header("location:{$_SERVER['PHP_SELF']}?ok");//redirect to login page and show the ok message
  } else {
    header("location:{$_SERVER['PHP_SELF']}?fail");//redirect to login page and show the fail message
  }
}
if (isset($_GET['confirm_order'])) {
  $id = $_GET['confirm_order'];
  $cStatus = $_GET['status'];
  $sql = "SELECT * FROM orders WHERE orderID = $id";
  $rs = mysqli_query($conn, $sql);
  $rc = mysqli_fetch_array($rs);
  if (($rc["status"] == "2" && $cStatus == "3")) {//only delivery order can change to completed order
    $sql = "UPDATE orders SET status = 3 WHERE orderID = $id";
    mysqli_query($conn,$sql);
    header("location:{$_SERVER['PHP_SELF']}?ok");//redirect to login page and show the ok message
  } else {
    header("location:{$_SERVER['PHP_SELF']}?fail");//redirect to login page and show the fail message
  }
}
if (isset($_GET["q"])) { //if keyword is provides
  $search = $_GET["q"];
  $sql = "SELECT * FROM orders WHERE dealerID = '{$_SESSION['dealerID']}' AND orderID LIKE '%$search%' ORDER BY orderID DESC";
  //echo $sql;
} else {
  $sql = "SELECT * FROM orders WHERE dealerID = '{$_SESSION['dealerID']}' ORDER BY orderID DESC";
}
$rs = mysqli_query($conn, $sql);

?>
<header class="mdc-top-app-bar app-bar" id="app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon">menu</button>
            <span class="mdc-top-app-bar__title">SMLCs Order System</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            <button id="demo-menu-lower-right" class="material-icons mdc-top-app-bar__action-item"
                    style="padding: 6px;font-size: 36px;">account_circle
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
              <?php if (!isset($_SESSION["dealerID"])) { ?>
                  <li class="mdl-menu__item" onclick="window.location.assign('login.php')">Log in</li>
                  <li class="mdl-menu__item" onclick="window.location.assign('register.php');">Sign up</li>
              <?php } else { ?>
                  <li class="mdl-menu__item" onclick="window.location.assign('login.php?logout=true'); ">Log out</li>
                  <li class="mdl-menu__item" onclick="window.location.assign('profile_editing.php');">Profile</li>
              <?php } ?>
            </ul>
        </section>
    </div>
</header>

<aside class="mdc-drawer mdc-drawer--dismissible" id="mdc-drawer">
    <div class="mdc-drawer__content">
        <nav class="mdc-list">
            <a class="mdc-list-item" href="history.php">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">history</i>
                <span class="mdc-list-item__text">Order History</span>
            </a>
            <a class="mdc-list-item" href="shopping_cart.php">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">shopping_cart</i>
                <span class="mdc-list-item__text">Make Order</span>
            </a>
        </nav>
    </div>
</aside>

<!--main content-->
<div class="mdc-drawer-app-content mdc-top-app-bar--fixed-adjust">
    <main class="main-content mdc_typography mdc-typography--subtitle2" id="main-content">

        <div class="form_lar">
            <h2 class="mdc-typography--headline4">Order History</h2>
            <ol class="mdc-typography--headline6">
                <li>You can search your order history on this page.</li>
                <li>You can cancel or confirm your order on this page.</li>
                <li>You can view the detail of orders.</li>
            </ol>
        </div>
        <div class="form_lar">
            <div class="ui aligned basic segment mdc-typography">
                <div class="ui left icon action input">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Order #" id="search">
                    <div class="ui blue submit button" id="btn_search">Search</div>
                </div>

                <h2 class="mdc-typography--headline5">Result</h2>
              <?php if (isset($_GET["ok"])) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="success-msg">Your action has been done successfully!</div>
                  </div>
              <?php } else if (isset($_GET["fail"])) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="error-msg">Fail! Please try again.</div>
                  </div>
              <?php } ?>
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr class="">
                        <th class="mdl-data-table__cell--non-numeric left_border table_header">Order Id</th>
                        <th class="mdl-data-table__cell--non-numeric left_border">Order Date</th>
                        <th>Delivery Address</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="orderlist">
                    <?php
                    while ($rc = mysqli_fetch_assoc($rs)) {
                      extract($rc);
                      $strStatus = "";
                      $button = "";
                      $cancel = "{$_SERVER['PHP_SELF']}?cancel_order=$orderID&status=4";//set cancel link
                      $confirm = "{$_SERVER['PHP_SELF']}?confirm_order=$orderID&status=3";//set confirm link
                      switch ($status) {
                        case 1:
                          $strStatus = "In processing";
                          $button = "<button type='button' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button action_button' onclick='window.location.assign(\"$cancel\")'>Cancel</button>";//only In processing order can be canceled
                          break;
                        case 2:
                          $strStatus = "Delivery";
                          $button = "<button type='button' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button action_button' onclick='window.location.assign(\"$confirm\")'>Confirm</button>";//only Delivery order can be confirmed
                          break;
                        case 3:
                          $strStatus = "Completed";
                          break;
                        case 4:
                          $strStatus = "Canceled";
                          break;
                      }
                      $orderlist = <<<HTML_CODE
                          <tr>
                        <td hidden><input type="text" name="partNumber" value="A12345"></td>
                        <td class="mdl-data-table__cell--non-numeric">$orderID</td>
                        <td class="mdl-data-table__cell--non-numeric center_border">$orderDate</td>
                        <td class="mdl-data-table__cell--non-numeric left_border">$deliveryAddress</td>
                        <td class="mdl-data-table__cell--non-numeric left_border">$strStatus</td>
                        <td><a href="#" onclick="window.open('detail.php?orderID=$orderID', '_blank', 'location=yes,height=720,width=1280,scrollbars=yes,status=yes')">View</a></span>
                        </td>
                        <td>
                            $button
                        </td>
                    </tr>
HTML_CODE;
                      echo $orderlist;
                    }
                    ?>
                    </tbody>

                </table>
            </div>
        </div>

    </main>
</div>
<?php mysqli_close($conn); ?>
<script src="./js/index.js"></script>
</body>
</html>
