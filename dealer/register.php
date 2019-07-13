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
    <link rel="stylesheet" href="./css/mdc_checkbox.css">
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
$error = 2;
$get = false;
//Database connection part
$hostname = "127.0.0.1";
$database = "projectDB";
$username = "root";
$password = "";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (isset($_POST["dealerID"])) {
  $get = true;
  extract($_POST);
  $sql = "INSERT INTO dealer VALUES('$dealerID','$password','$name','$phoneNumber','$address')";
  $rs = mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) < 1) {
    $error = 1;
  } else {
    $error = 0;
    $get = false;
  }
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

        <div class="form_mid">
          <?php if ($error == 0) { ?>
              <h3>Sign up Successfully!</h3>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <?php echo "<div class='success-msg'>Your ID <a herf='#'>$dealerID</a> has been registered successfully!</div><br>" ?>
                  Automatically redirect to login page in <span id="timer"></span> second(s) later.
                <?php
                echo "<script> 
                            timer = 3;
                            $('#timer').text(timer);
                            setTimeout(function(){ //set a timer
                                window.location.assign('login.php'); //when the timer is 0, do the action
                            },3000) //3 seconds of timer
                            interval = setInterval(function() { //use interval to show the timer in real time. 
                              $('#timer').text(--timer); //set the text of the timer on HTML and decrease the timer by 1
                              if(timer == 0) clearInterval(interval); //clear the interval
                            },1000); // every 1 second does once.
                         </script>";
                ?>
              </div>
          <?php } else { ?>
              <h3>Sign up as a dealer</h3>
              <i class="material-icons ac_icon">
                  account_circle
              </i>

            <?php if ($error == 1) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="error-msg"><?php echo "*$dealerID has been used."; ?></div>
                  </div>
            <?php } ?>
              <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">

                  <!--        Dealer Id Input box-->
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                      <input class="mdl-textfield__input" name="dealerID" type="text" id="dealerId"
                             title=">=6 letters or digits" pattern="[a-zA-Z\d]{3,50}" maxlength="50"
                             placeholder="e.g.:john123" value="<?php if ($get) echo $dealerID; ?>" required>
                      <label class="mdl-textfield__label" for="dealerId">Dealer's ID</label>
                  </div>

                  <!--        password-->
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                      <input class="mdl-textfield__input" name="password" type="password" id="password"
                             title=">=6 letters or digits" pattern="[a-zA-Z\d]{6,50}" maxlength="50"
                             placeholder="e.g.:axe35z" value="<?php if ($get) echo $password; ?>" required>
                      <label class="mdl-textfield__label" for="password">Password</label>
                  </div>

                  <!--Dealer name input box-->
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                      <input class="mdl-textfield__input" name="name" type="text" id="dealerName"
                             title=">=3 letters or spaces" pattern="[a-zA-Z\d]{3,50}" maxlength="50"
                             placeholder="e.g.:John" value="<?php if ($get) echo $name; ?>" required>
                      <label class="mdl-textfield__label" for="dealerName">Dealer's Name</label>
                  </div>

                  <!--    Phone no-->
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                      <input class="mdl-textfield__input" name="phoneNumber" type="text" id="phoneNo" title="8 digits"
                             pattern="[\d]{8,}" maxlength="8" placeholder="e.g.:24333333"
                             value="<?php if ($get) echo $phoneNumber; ?>" required>
                      <label class="mdl-textfield__label" for="phoneNo">Phone Number</label>
                  </div>

                  <!--    Address -->
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                      <input class="mdl-textfield__input" name="address" type="text" id="address"
                             title=">=5 letters or commas or full stops or digits " pattern="[a-zA-Z\d., ]{5,255}"
                             maxlength="255" placeholder="e.g.:Flat 14/A, O House, Hello Road.  14/A"
                             value="<?php if ($get) echo $address; ?>" required>
                      <label class="mdl-textfield__label" for="address">Address</label>
                  </div>

                  <!--        checkbox agreement google lib-->
                  <div class="mdc-form-field">
                      <div class="mdc-checkbox">
                          <input type="checkbox" class="mdc-checkbox__native-control" id="checkbox-1" required/>
                          <div class="mdc-checkbox__background">
                              <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                  <path class="mdc-checkbox__checkmark-path" fill="none"
                                        d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                              </svg>
                              <div class="mdc-checkbox__mixedmark"></div>
                          </div>
                      </div>
                      <label for="checkbox-1">I agree to the Terms and Conditions</label>
                  </div>

                  <!--        alignment-->
                  <div style="display: block;"></div>

                  <!--        submit-->
                  <button type="submit"
                          class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                      Register
                  </button>
                  <button type="reset"
                          class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                      Reset
                  </button>
              </form>
              <div class="form_last_lab">have account? <a href="login.php">log in</a></div>
          <?php } ?>
        </div>

    </main>
</div>
<?php
//mysqli_free_result($rs);
mysqli_close($conn);
?>
<script src="./js/index.js"></script>
</body>
</html>