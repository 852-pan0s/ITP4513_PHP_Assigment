<!DOCTYPE html>
<html>

<head>
    <script src="../dealer/node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="../dealer/css/mdc_typography.css">

    <!--top / menu bar lib-->
    <link rel="stylesheet" href="../dealer/css/index.css">
    <!--  <script src="../dealer/js/index.js"></script>-->

    <!--mdc optional-->
    <!--  <link rel="stylesheet" href="../dealer/css/shopping.css">-->
    <!--  <script src="../dealer/js/shopping.js"></script>-->
    <!--  <link rel="stylesheet" href="../dealer/css/mdc_checkbox.css">-->
    <!--  <script src="../dealer/js/mdc_checkbox.js"></script>-->

    <!--  semantic-ui library-->
    <link rel="stylesheet" type="text/css" href="../dealer/node_modules/semantic-ui/dist/semantic.min.css">
    <script src="../dealer/node_modules/semantic-ui/dist/semantic.min.js"></script>

    <!-- material-design life lib-->
    <link rel="stylesheet" href="../dealer/node_modules/material-design-lite/material.min.css">
    <script src="../dealer/node_modules/material-design-lite/material.min.js"></script>

    <!--  my css or js-->
    <link rel="stylesheet" href="../dealer/css/mycss.css">
    <script src="../dealer/js/myjs.js"></script>
    <link rel="stylesheet" href="./css/mycss.css">

</head>

<body class="mdc-typography">

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
?>

<header class="mdc-top-app-bar app-bar" id="app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <button class="material-icons mdc-top-app-bar__navigation-icon">menu</button>
            <span class="mdc-top-app-bar__title">SMLCs Order System (Admin)</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            <button id="demo-menu-lower-right" class="material-icons mdc-top-app-bar__action-item"
                    style="padding: 6px;font-size: 36px;">account_circle
            </button>

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
              <?php if (!isset($_SESSION["email"])) { ?>
                  <li class="mdl-menu__item" onclick="window.location.assign('login.php')">Log in</li>
              <?php } else { ?>
                  <li class="mdl-menu__item" onclick="window.location.assign('login.php?logout=true'); ">Log out</li>
              <?php } ?>
            </ul>

        </section>
    </div>
</header>
<aside class="mdc-drawer mdc-drawer--dismissible" id="mdc-drawer">
    <div class="mdc-drawer__content">
        <nav class="mdc-list">

            <a class="mdc-list-item" href="manage_order.php">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">build</i>
                <span class="mdc-list-item__text">Manage Order</span>
            </a>

            <a class="mdc-list-item" href="manage_part.php">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">build</i>
                <span class="mdc-list-item__text">Manage Part</span>
            </a>
        </nav>
    </div>
</aside>

<!--main content-->
<div class="mdc-drawer-app-content mdc-top-app-bar--fixed-adjust">
    <main class="main-content mdc_typography mdc-typography--subtitle2" id="main-content">

        <div class="form_lar">
            <h2 class="mdc-typography--headline4">Manage Order</h2>
            <ol class="mdc-typography--headline6">
                <li>You can search your order history on this page.</li>
                <li>Latest 10 records of the history will be shown below.</li>
            </ol>
        </div>
        <div class="form_lar">
            <div class="ui aligned basic segment mdc-typography">
                <div class="ui left icon action input">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Order #">
                    <div class="ui blue submit button">Search</div>
                </div>

                <h2 class="mdc-typography--headline5">Result</h2>
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr class="">
                        <th class="mdl-data-table__cell--non-numeric table_header">Order Id</th>
                        <th>Dealer ID</th>
                        <th>Dealer Name</th>
                        <th>Order Date</th>
                        <th>Delivery Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="orderlist">
                    <tr>
                        <td hidden><input type="text" name="partNumber" value="A12345"></td>
                        <td class="mdl-data-table__cell--non-numeric">1</td>
                        <td><span id="date1">1</span></td>
                        <td><span id="address1">John</span></td>
                        <td><span id="status1">2019-06-18</span></td>
                        <td><span id="status1">Hello Road</span></td>
                        <td>
                            <button id="action1" type="button" id="btn_concel"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button action_button"
                                    onclick="window.open('detail.php', '_blank', 'location=yes,height=720,width=1280,scrollbars=yes,status=yes')">
                                View
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="../dealer/js/index.js"></script>
</body>

</html>
