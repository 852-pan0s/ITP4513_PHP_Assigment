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
//Database connection part
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
session_start();
$error = false;
if (isset($_GET["logout"])) {
  if ($_GET["logout"]) {
    session_destroy();
    header("location:login.php");
  }
} else
  if (!isset($_SESSION["email"])) { //if the dealer does not log in before
    if (isset($_POST["email"])) { //if the dealer click "login"
      extract($_POST);

      $sql = "SELECT * FROM administrator WHERE email = '$email' AND password = '$password'";
      $rs = mysqli_query($conn, $sql);
      if (mysqli_num_rows($rs) > 0) {
        session_start();
        $_SESSION["email"] = $email;
        header("location:manage_order.php");
      } else {
        $error = true;
      }
      mysqli_free_result($rs);
    }
  } else {
    header("location:manage_order.php");
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

        <div class="form_min">
            <h3>Log in</h3>
            <i class="material-icons ac_icon">
                account_circle
            </i>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">

              <?php if ($error) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="error-msg">*Invalid Account.</div>
                  </div>
              <?php } ?>

                <!--        Dealer Id Input box-->
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                    <input class="mdl-textfield__input" name="email" type="email" id="email" maxlength="255" required>
                    <label class="mdl-textfield__label" for="email">Email</label>
                </div>

                <!--        password-->
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                    <input class="mdl-textfield__input" name="password" type="password" id="password" maxlength="50"
                           required>
                    <label class="mdl-textfield__label" for="password">Password</label>
                </div>
                <!--        alignment-->
                <div style="display: block;"></div>

                <!--        submit-->
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                    Log in
                </button>
            </form>
        </div>

    </main>
</div>
<script src="../dealer/js/index.js"></script>
</body>
</html>
