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
    <!--
    <link rel="stylesheet" href="./css/shopping.css">
    <script src="./js/shopping.js"></script>
  -->
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

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
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
$neworder = false;
if (!isset($_SESSION["dealerID"])) {
  header("location:login.php");
} else {
  $sql = "SELECT * FROM dealer WHERE dealerID = '{$_SESSION['dealerID']}'";
  $rs = mysqli_query($conn, $sql); // Get dealer information
  $rc = mysqli_fetch_assoc($rs); // Take the first row
  extract($rc);
}


if (isset($_GET["neworder"])) {
  if ($_GET["neworder"]) {
    $_SESSION[$dealerID]["shopping_cart"] = true;
    header("location:shopping_cart.php");
  }
}
if (isset($_SESSION[$dealerID]["shopping_cart"])) {
  if ($_SESSION[$dealerID]["shopping_cart"] == true) {
    echo "<script>showShoppingCart();</script>"; //set the max height of shopping_cart div and hide the New button
  }
}
if (isset($_GET["add"])) { //add part
  $partList = explode(",", $_GET["add"]); //convert string to array by ','
  foreach ($partList as $key => $value) {
    $_SESSION["shopping_cart"][$value]["partNumber"] = "$value";
    header("location:shopping_cart.php");
  }
}
if (isset($_GET["delete"])) {//delete part
  delete($_GET["delete"]);
  header("location:shopping_cart.php");
}

if (isset($_GET["address"])) {
  $skip = 0;
  $delete = "";
  $deliveryAddress = $_GET["address"];
  $today = date("Y-m-d");
  $sql = "INSERT INTO orders VALUES(null,'$dealerID','$today','$deliveryAddress',1)";
  mysqli_query($conn, $sql); //Create a new order
  foreach ($_GET as $part => $quantity) {
    if ($skip++ == 0) continue; //skip the first element (delivery address)
   // echo "$part = $quantity<br>";
    $delete .= $part.",";
    $_SESSION["placeOrder"][$part] = "$quantity";
    $sql = "SELECT * FROM orders WHERE dealerID = '$dealerID' ORDER BY orderID DESC";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);
  }
  foreach ($_SESSION["placeOrder"] as $part => $quantity) {
    $sql = "SELECT * FROM part WHERE partNumber = $part";
    $rs = mysqli_query($conn, $sql);
    $rc = mysqli_fetch_assoc($rs);
    extract($rc);
    $sql = "UPDATE part set stockQuantity = stockQuantity-$quantity WHERE partNumber = $part";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO orderpart VALUES($orderID, $part, $quantity,$stockPrice)";
    mysqli_query($conn, $sql);
  }

  unset($_SESSION["placeOrder"]);
  $deletePart = substr($delete,0,strlen($delete)-1); //remove last ','
  //echo($deletePart);
  delete($deletePart);
  header("location:shopping_cart.php");
}

function delete($delete)
{
  $partList = explode(",", $delete); //convert string to array by ','
  foreach ($partList as $key => $value) {
//      echo "$value";
    unset($_SESSION["shopping_cart"][$value]);
  }
}
?>


<script>
    $(document).ready(function () {
        $('#btn_buy').on('click', function () {
            var $get = "?address=" + $("#address").val();
            var shopping_partlist = document.getElementById('partList').children; //tbody
            for (i = 0; i < shopping_partlist.length; i++) {
                if (shopping_partlist[i].classList.contains('is-selected')) {//tbody>tr>td>label>input first column (checkbox)
                    var partNumber = shopping_partlist[i].children[1].textContent;//tbody>tr>td(id)
                    var quantity = shopping_partlist[i].children[3].children[0].value;//tbody>tr>td>input(quantity)
                    $get += `&${partNumber}=${quantity}`;
                }
            }
            console.log($get);
            window.location.assign(`<?php echo $_SERVER["PHP_SELF"] ?>${$get}`); //add part to the shopping cart
        });

        $('#btn_delete').on('click', function () {
            var $get = "?delete=";
            var shopping_partlist = document.getElementById('partList').children; //tbody
            for (i = 0; i < shopping_partlist.length; i++) {
                if (shopping_partlist[i].classList.contains('is-selected')) {//tbody>tr>td>label>input first column (checkbox)
                    var partNumber = shopping_partlist[i].children[1].textContent;//tbody>tr>td
                    $get += `${partNumber},`;
                }
            }
            $get = $get.substring(0, $get.length - 1); //remove last ,
            console.log($get);
            window.location.assign(`<?php echo $_SERVER["PHP_SELF"] ?>${$get}`); //add part to the shopping cart
        });


        $('#btn_add').on('click', function () {
            var $get = "?add=";
            var shopping_partlist = document.getElementById('selectpart').children; //tbody
            for (i = 0; i < shopping_partlist.length; i++) {
                if (shopping_partlist[i].children[0].children[0].children[0].checked) {//tbody>tr>td>label>input first column (checkbox)
                    var partNumber = shopping_partlist[i].children[1].textContent;//tbody>tr>td
                    $get += `${partNumber},`;
                }
            }
            $get = $get.substring(0, $get.length - 1); //remove last ,
            window.location.assign(`<?php echo $_SERVER["PHP_SELF"] ?>${$get}`); //add part to the shopping cart
        });
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

        <div class="form_lar">
            <h2 class="mdc-typography--headline4">New Order</h2>
            <ol class="mdc-typography--headline6">
                <li>You can place an order on this page.</li>
                <li>To place an order please follow the step that shown below.</li>
            </ol>
        </div>
        <div class="form_lar">
            <h2 class="mdc-typography--headline5">Step</h2>
            <div class="my--mainContent-header">
                <!--status: step active disabled-->
                <div class="ui steps">
                    <div class="active step">
                        <i class="cart arrow down icon"></i>
                        <div class="content">
                            <div class="title">Place Order</div>
                            <div class="description">Add parts and place your order.</div>
                        </div>
                    </div>
                    <div class="disabled step">
                        <i class="payment icon"></i>
                        <div class="content">
                            <div class="title">Billing</div>
                            <div class="description">Enter billing information</div>
                        </div>
                    </div>
                    <div class="disabled step">
                        <i class="info icon"></i>
                        <div class="content">
                            <div class="title">Confirm Order</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--New order-->
        <div class="form_lar">
            <h2 class="mdc-typography--headline5">Order</h2>
            <button id="btn_new" type="button"
                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                    onclick="window.location.assign('shopping_cart.php?neworder=true')">New
            </button>

            <div id="shopping_cart">
                <div>
                    <!--      form method="post"-->
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get" id="order"
                          onchange="selectedCheckBox()">
                        <!--   control bar-->
                        <div class="my-control-bar">
                            <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                                    data-toggle="modal" data-target="#exampleModalCenter" onclick="init_btn_add();">Add
                                Parts
                            </button>


                            <button type="button" id="btn_buy"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                                    disabled="disabled">Place Order
                            </button>

                            <button type="button" id="btn_delete"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                                    disabled="disabled">Delete
                            </button>

                        </div>
                        <ul type="none" class="mdc-typography--headline6">
                            <!--                            <li>-->
                            <!--            order id-->
                            <!--                                Order ID: <span name="orderID">php-orderId</span>-->
                            <!--                            </li>-->
                            <li>
                                <!--    Delivery address-->
                                Delivery Address:
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" name="deliveryAddress" type="text" id="address"
                                           title="8 digits" pattern="[a-zA-Z\d., ]{5,255}" maxlength="255"
                                           placeholder="e.g.:flat  14/A, O house, Hello Road Street"
                                           value="<?php echo $address; ?>"
                                           readonly required style="padding: 0">
                                </div>

                                <!--        checkbox for default address google lib-->
                                <div class="mdc-form-field">
                                    <div class="mdc-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control"
                                               id="use_default_addr" checked
                                               onclick="isCheckedDefault('<?php echo $address; ?>');"/>
                                        <div class="mdc-checkbox__background">
                                            <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                                <path class="mdc-checkbox__checkmark-path" fill="none"
                                                      d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                            </svg>
                                            <div class="mdc-checkbox__mixedmark"></div>
                                        </div>
                                    </div>
                                    <label for="use_default_addr">Use default address as delivery address</label>
                                </div>
                            </li>
                        </ul>


                        <div style="margin-top: 24px;">
                            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
                                <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">#ID</th>
                                    <th class="mdl-data-table__cell--non-numeric">Part Name</th>
                                    <th>Quantity</th>
                                    <th>Stock</th>
                                    <th>Unit price</th>
                                    <th>Total price</th>
                                </tr>
                                </thead>
                                <tbody id="partList">

                                <?php
                                if (isset($_SESSION["shopping_cart"])) { //if the dealer has added a part to the shopping cart
                                  foreach ($_SESSION["shopping_cart"] as $key => $order) { //$order is the part that in the shopping cart
                                    $sql = "SELECT * FROM part WHERE partNumber = {$order['partNumber']}"; //get the information of the part
                                    $rs = mysqli_query($conn, $sql);
                                    $rc = mysqli_fetch_assoc($rs);
                                    extract($rc);
                                    $orderline = <<<HTML_CODE
   <tr class="tr_part">
         <td class="mdl-data-table__cell--non-numeric td_partNumber">$partNumber</td>
      <td class="mdl-data-table__cell--non-numeric td_partNumber">$partName</td>
      <td>
        <input type="number" id="qty{$order['partNumber']}" class="rightAlign" value="1" max="$stockQuantity" min="1"                     onchange="countAmount('#qty{$order['partNumber']}','#price{$order['partNumber']}','#total{$order['partNumber']}');" required>
      </td>
      <td><span id="stock{$order['partNumber']}">$stockQuantity</span></td>
      <td>$<span id="price{$order['partNumber']}">$stockPrice</span></td>
      <td>$<span id="total{$order['partNumber']}">$stockPrice</span></td>
   </tr>
HTML_CODE;
                                    echo $orderline; //print the table row (order line in the shopping cart)
                                  }
                                }
                                ?>
                                </tbody>
                            </table>
                            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                                <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">Total Amount</th>
                                    <th>$<span id="totalAmount">0</span></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Part list:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ui aligned basic segment mdc-typography">
                    <div class="ui left icon action input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="Part name">
                        <div class="ui blue submit button">Search</div>
                    </div>
                    <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp"
                           onchange="selectedCheckBoxFromDB()">
                        <thead id="tbl_part_list_head">
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric text_left">#ID</th>
                            <th class="mdl-data-table__cell--non-numeric text_left full">Part Name</th>
                            <th class="mdl-data-table__cell--non-numeric text_left">Stock</th>
                            <th class="mdl-data-table__cell--non-numeric text_left">Unit price</th>
                        </tr>
                        </thead>
                        <tbody id="selectpart">

                        <?php
                        $sql = "SELECT * FROM part"; //get the information of all part
                        $rs = mysqli_query($conn, $sql);
                        while ($rc = mysqli_fetch_assoc($rs)) {
                          extract($rc);
                          if ($stockStatus == 2) continue;//2 = "Unavailable": The parts are unavailable (e.g. parts have defects). Skip the part.
                          $partList = <<<HTML_CODE
<tr>
    <td class="mdl-data-table__cell--non-numeric text_left">$partNumber</td>
    <td class="mdl-data-table__cell--non-numeric text_left">$partName</td>
    <td class="mdl-data-table__cell--non-numeric text_left">$stockQuantity</td>
    <td class="mdl-data-table__cell--non-numeric text_left">$$stockPrice</td>
</tr>
HTML_CODE;
                          echo $partList;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <!--          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button id="btn_add" type="button" class="btn btn-primary" data-dismiss="modal" disabled="disabled">
                        Add
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
mysqli_free_result($rs);
mysqli_close($conn);
?>
<script src="./js/index.js"></script>
</body>

</html>
