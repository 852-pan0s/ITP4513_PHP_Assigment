<!DOCTYPE html>
<html>
<head>
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
if (!isset($_SESSION["dealerID"])) {
  header("location:login.php");
}
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
                  <li class="mdl-menu__item"
                  <li class="mdl-menu__item" onclick="window.location.assign('login.php?logout=true'); ">Log out</li>
                  </li>
                  <li class="mdl-menu__item" onclick="window.location.assign('profile_editing.php');">Profile</li>
              <?php } ?>
            </ul>
        </section>
    </div>
</header>

<aside class="mdc-drawer mdc-drawer--dismissible" id="mdc-drawer">
    <div class="mdc-drawer__content" onclick="adjustIframe();">
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
                        <th>Order Date</th>
                        <th>Delivery Address</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="orderlist">
                    <tr>
                        <td hidden><input type="text" name="partNumber" value="A12345"></td>
                        <td class="mdl-data-table__cell--non-numeric">1</td>
                        <td><span id="date1">2019-06-06</span></td>
                        <td><span id="address1">Flat 14/A, Hello Road</span></td>
                        <td><span id="status1">In Process</span></td>
                        <td><span id="detail1"><a
                                        onclick="window.open('detail.html', '_blank', 'location=yes,height=720,width=1280,scrollbars=yes,status=yes')">View</a></span>
                        </td>
                        <td>
                            <button id="action1" type="button" id="btn_concel"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button action_button">
                                Concel
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td hidden><input type="text" name="partNumber" value="A12345"></td>
                        <td class="mdl-data-table__cell--non-numeric">2</td>
                        <td><span id="date2">2019-06-06</span></td>
                        <td><span id="address2">Flat 14/A, Hello Road</span></td>
                        <td><span id="status2">Delivery</span></td>
                        <td><span id="detail2"><a
                                        onclick="window.open('detail.html', '_blank', 'location=yes,height=720,width=1280,scrollbars=yes,status=yes')">View</a></span>
                        </td>
                        <td>
                            <button id="action2" type="button" id="btn_confirm"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button action_button">
                                Confirm
                            </button>
                        </td>
                    </tr>
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