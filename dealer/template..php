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

    <!--bootstrap-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>

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
}else{
    $sql = "SELECT * FROM dealer WHERE dealerID = '{$_SESSION['dealerID']}'";
    $rs = mysqli_query($conn,$sql); // Get dealer information
    $rc = mysqli_fetch_assoc($rs); // Take the first row
    extract($rc);
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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
            Launch demo modal
        </button>

    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php mysqli_close($conn);?>
<script src="./js/index.js"></script>
</body>
</html>