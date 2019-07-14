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
    <link rel="stylesheet" href="../dealer/css/mdc-dropdown.css">

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
  $sql = "SELECT * FROM part ORDER BY partNumber DESC";
  $rs = mysqli_query($conn, $sql); // Get dealer information
  $rc = mysqli_fetch_assoc($rs); // Take the first row
  extract($rc);
  $status = $stockStatus == 1 ? "Available" : "Unavailable";
}

$oName = ""; // old part name
$oQty = "";
$oPrice ="";
$oStatus = "";

?>

<header class="mdc-top-app-bar app-bar" id="app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <span class="mdc-top-app-bar__title">SMLCs Order System (Admin)</span>
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
        <div class="form_mid">
            <h2 class="mdc-typography--headline4">New Part</h2>

            <form action="update_part.php" method="post">
                <input type="text" name="new" hidden>
              <?php if (isset($_GET["ok"])) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="success-msg">New part added Successfully!</div>
                  </div>
              <?php }else if (isset($_GET["fail"])) {
                $oName = $_GET['partName'];
                $oQty = $_GET['stockQuantity'];
                $oPrice = $_GET['stockPrice'];
                $oStatus = $_GET['stockStatus']==1?"Available":"Unavailable";
                  ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="error-msg">New part added Fail!<br>Please try again.</div>
                  </div>
              <?php } ?>
                <ul type="none" class="mdc-typography--headline6">
                    <li>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                             style="display: block;">
                            <input class="mdl-textfield__input" name="partNumber" type="text" id="partNumber"
                                   value="<?php echo $partNumber + 1; ?>" readonly>
                            <label class="mdl-textfield__label" for="partNumber">Part Number</label>
                        </div>
                    </li>
                    <li>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                             style="display: block;">
                            <input class="mdl-textfield__input" name="partName" type="text" id="partName"
                                   value="<?php echo $oName?>" placeholder="e.g.:<?php echo $partName; ?>" pattern="[a-zA-Z\d_ ()&,.\-/]{3,100}"
                                   maxlength="100" required>
                            <label class="mdl-textfield__label" for="partName">Part Name</label>
                        </div>
                    </li>
                    <li>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                             style="display: block;">
                            <input class="mdl-textfield__input" name="stockQuantity" type="number" id="stockQuantity"
                                   value="<?php echo $oQty?>" placeholder="e.g.:<?php echo $stockQuantity; ?>" max="99999999" min="0" required>
                            <label class="mdl-textfield__label" for="stockQuantity">Stock Quantity</label>
                        </div>
                    </li>
                    <li>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                             style="display: block;">
                            <input class="mdl-textfield__input" name="stockPrice" type="number" id="stockPrice"
                                   value="<?php echo $oPrice?>" placeholder="e.g.:<?php echo $stockPrice; ?>" max="9999999" min="0" required>
                            <label class="mdl-textfield__label" for="stockPrice">Stock Price</label>
                        </div>
                    </li>
                    <li>
                        <div class="mdc-select demo-width-class">
                            <input type="hidden" name="stockStatus" value="<?php echo $oStatus?>" id="status">
                            <i class="mdc-select__dropdown-icon"></i>
                            <div class="mdc-select__selected-text"></div>
                            <div class="mdc-select__menu mdc-menu mdc-menu-surface status_list_width">
                                <ul class="mdc-list">
                                    <li class="mdc-list-item" data-value="Available">
                                        Available
                                    </li>
                                    <li class="mdc-list-item" data-value="Unavailable">
                                        Unavailable
                                    </li>
                                </ul>
                            </div>
                            <span class="mdc-floating-label">Status</span>
                            <div class="mdc-line-ripple"></div>
                        </div>
                    </li>
                    <li>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"
                             style="display: block;">
                            <input class="mdl-textfield__input" name="email" type="text" id="email"
                                   value="<?php echo $email ?>" maxlength="100" required readonly>
                            <label class="mdl-textfield__label" for="email">email (who added the spare?)</label>
                        </div>
                    </li>
                    <button type="submit"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        Save
                    </button>
                    <button type="button"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                            onclick="window.close();">
                        Close
                    </button>
                </ul>
            </form>
        </div>

    </main>
</div>
<script src="../dealer/js/mdc-dropdown.js"></script>
<script src="../dealer/js/index.js"></script>
</body>
</html>
 
