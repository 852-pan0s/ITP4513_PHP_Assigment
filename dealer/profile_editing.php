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
$error = 2;
$saved = false;
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!isset($_SESSION["dealerID"])) {
  header("location:login.php");
} else {
  $sql = "SELECT * FROM dealer WHERE dealerID = '{$_SESSION['dealerID']}'";
  $rs = mysqli_query($conn, $sql);
  $rc = mysqli_fetch_assoc($rs);
  extract($rc);
  if(isset($_GET["error"])){
    $error = $_GET["error"];
  }
  if(isset($_GET["saved"])){
    $saved = $_GET["saved"];
  }
  if(isset($_GET["password"])){
    extract($_GET);
    $sql = "UPDATE dealer SET password = '$password', name = '$name', phoneNumber = '$phoneNumber', address = '$address' WHERE dealerID = '$dealerID'";
    $saved=true;
    //echo $sql;
    mysqli_query($conn,$sql);
    header("location:{$_SERVER['PHP_SELF']}?saved=true");
  }else if(isset($_GET["name"])){
    extract($_GET);
    $sql = "UPDATE dealer SET name = '$name', phoneNumber = '$phoneNumber', address = '$address' WHERE dealerID = '$dealerID'";
    //echo $sql;
    mysqli_query($conn,$sql);
    header("location:{$_SERVER['PHP_SELF']}?saved=true");
  }

  ?>
    <script>
        $(document).ready(function () {
            $("#new_password").on('input', function () {
                if ($(this).val().length > 0) {
                    $(this).attr("pattern", "[a-zA-Z\\d]{6,50}");

                    $("#confirm_password_div").css("maxHeight", "1000px");
                    $("#confirm_password_div input, #confirm_password_div label").css("display", "block");
                    if ($("#confirm_password").val() !== $("#new_password").val()) {
                        $("#confirm_password_div").addClass("is-invalid");
                    } else {
                        $("#confirm_password_div").removeClass("is-invalid");
                    }
                } else {
                    $("#confirm_password_div").css("maxHeight", "0");
                    $("#confirm_password_div input, #confirm_password_div label").css("display", "none");
                    $(this).removeAttr("pattern");
                }
            });
            $("#confirm_password").on('change', function () {
                if ($(this).val() === $("#new_password").val()) {
                    $(this).removeAttr("required");
                } else {
                    $(this).attr("required", "required");
                    $("#confirm_password_div").addClass("is-invalid");
                }
            });
            $("#btn_save").on("click", function () {
                if ($("#password").val() == <?php echo $password?>) {
                    var new_password = $("#confirm_password").val();
                    var name = $("#dealerName").val();
                    var phoneNumber = $("#phoneNo").val();
                    var address = $("#address").val();
                    if ($("#new_password").val().length > 0) {
                        console.log("OK");
                        if ($("#new_password").val() === $("#confirm_password").val()) {
                            window.location.assign(`<?php $_SERVER["PHP_SELF"]?>?password=${new_password}&name=${name}&phoneNumber=${phoneNumber}&address=${address}`);
                        }
                    } else {
                        window.location.assign(`<?php $_SERVER["PHP_SELF"]?>?name=${name}&phoneNumber=${phoneNumber}&address=${address}`);
                    }
                }else{
                    window.location.assign(`<?php $_SERVER["PHP_SELF"]?>?error=1`);
                }
            })
        });
    </script>
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
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="demo-menu-lower-right">
                  <?php if (!isset($_SESSION["dealerID"])) { ?>
                      <li class="mdl-menu__item" onclick="window.location.assign('login.php')">Log in</li>
                      <li class="mdl-menu__item" onclick="window.location.assign('register.php');">Sign up</li>
                  <?php } else { ?>
                      <li class="mdl-menu__item"
                      <li class="mdl-menu__item" onclick="window.location.assign('login.php?logout=true'); ">Log out
                      </li>
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

            <div class="form_mid">
                <h3>Profile Editing</h3>
                <i class="material-icons ac_icon">
                    account_circle
                </i>
              <?php if ($error == 1) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="error-msg"><?php echo "*Password is not correct."; ?></div>
                  </div>
              <?php } ?>
              <?php if ($saved == true) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="success-msg"><?php echo "Profile saved!"; ?></div>
                  </div>
              <?php } ?>
                <form action="" method="post" onsubmit="return false;">

                    <!--        Dealer Id Input box-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="dealerID" type="text" id="dealerId"
                               value="<?php echo $dealerID ?>" readonly>
                        <label class="mdl-textfield__label" for="dealerId">Dealer’s ID</label>
                    </div>

                    <!--        password-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="password" type="password" id="password"
                               title=">=6 letters or digits" pattern="[a-zA-Z\d]{6,50}" maxlength="50"
                               required="required">
                        <label class="mdl-textfield__label" for="password">Password</label>
                    </div>

                    <!--        new password-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="new_password" type="password" id="new_password"
                               title=">=6 letters or digits" maxlength="50">
                        <label class="mdl-textfield__label" for="password">New Password</label>
                    </div>

                    <!--        comfirm password-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="confirm_password_div"
                         style="display: block;">
                        <input class="mdl-textfield__input" type="password" id="confirm_password"
                               title=">=6 letters or digits" maxlength="50">
                        <label class="mdl-textfield__label" for="confirm_password">Re Enter Password</label>
                    </div>

                    <!--Dealer name input box-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="name" type="text" id="dealerName"
                               title=">=3 letters or spaces" pattern="[a-zA-Z ]{3,50}" maxlength="50"
                               value="<?php echo $name ?>" required>
                        <label class="mdl-textfield__label" for="dealerName">Dealer’s Name</label>
                    </div>

                    <!--    Phone no-->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="phoneNumber" type="text" id="phoneNo" title="8 digits"
                               pattern="[\d]{8,}" maxlength="8" value="<?php echo $phoneNumber ?>" required>
                        <label class="mdl-textfield__label" for="phoneNo">Phone Number</label>
                    </div>

                    <!--    Address -->
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                        <input class="mdl-textfield__input" name="address" type="text" id="address"
                               title=">=5 letters or commas or full stops or digits " pattern="[a-zA-Z\d., ]{5,255}"
                               maxlength="255" value="<?php echo $address ?>">
                        <label class="mdl-textfield__label" for="address">Address</label>
                    </div>

                    <!--        alignment-->
                    <div style="display: block;"></div>

                    <!--        submit-->
                    <button type="submit" id="btn_save"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        SAVE
                    </button>

                    <button type="reset"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        Reset
                    </button>
                </form>
            </div>

        </main>
    </div>
  <?php
  mysqli_free_result($rs);
  mysqli_close($conn);
} ?>
<script src="./js/index.js"></script>
</body>
</html>
 
