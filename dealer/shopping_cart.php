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
                    onclick="showShoppingCart();">New
            </button>

            <div id="shopping_cart">
                <!--   control bar-->
                <div class="my-control-bar">
                    <button type="button"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                            data-toggle="modal" data-target="#exampleModalCenter" onclick="init_btn_add();">Add Parts
                    </button>


                    <button type="button" id="btn_buy"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                            onclick="placeOrder();" disabled="disabled">Place Order
                    </button>

                    <button type="button" id="btn_delete"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent my-control-bar-button"
                            disabled="disabled">Delete
                    </button>

                </div>
                <div>
                    <!--      form method="post"-->
                    <form action="" method="get" id="order" onchange="selectedCheckBox()">
                        <ul type="none" class="mdc-typography--headline6">
                            <li>
                                <!--            order id-->
                                Order ID: <span name="orderID">php-orderId</span>
                            </li>
                            <li>
                                <!--    Delivery address-->
                                Delivery Address:
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" name="deliveryAddress" type="text" id="address"
                                           title="8 digits" pattern="[a-zA-Z\d., ]{5,255}" maxlength="255"
                                           placeholder="e.g.:flat  14/A, O house, Hello Road Street" value="<?php echo $address;?>"
                                           readonly required style="padding: 0">
                                </div>

                                <!--        checkbox for default address google lib-->
                                <div class="mdc-form-field">
                                    <div class="mdc-checkbox">
                                        <input type="checkbox" class="mdc-checkbox__native-control"
                                               id="use_default_addr" checked onclick="isCheckedDefault(<?php $address;?>);"/>
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
                                    <th class="mdl-data-table__cell--non-numeric">Part Name</th>
                                    <th>Quantity</th>
                                    <th>Stock</th>
                                    <th>Unit price</th>
                                    <th>Total price</th>
                                </tr>
                                </thead>
                                <tbody id="partlist">
                                <tr>
                                    <td hidden><span name="partNumber">A12345</span></td>
                                    <td class="mdl-data-table__cell--non-numeric">Part A</td>
                                    <td>
                                        <input type="number" id="qty1" class="rightAlign" value="1" max="99999" min="1"
                                               onchange="countAmount(qty1,price1,total1);" required>
                                    </td>
                                    <td><span id="stock1">1000</span></td>
                                    <td>$<span id="price1">1000</span></td>
                                    <td>$<span id="total1">1000</span></td>
                                </tr>

                                <tr>
                                    <td hidden><span name="partNumber">B12345</span></td>
                                    <td class="mdl-data-table__cell--non-numeric">Part B</td>
                                    <td>
                                        <input type="number" id="qty2" class="rightAlign" value="1" max="99999" min="1"
                                               onchange="countAmount(qty2,price2,total2);" required>
                                    </td>
                                    <td><span id="stock1">1000</span></td>
                                    <td>$<span id="price2">1000</span></td>
                                    <td>$<span id="total2">1000</span></td>
                                </tr>
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
                        <thead id="db_list_head">
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric full">Part Name</th>
                            <th>Stock</th>
                            <th>Unit price</th>
                        </tr>
                        </thead>
                        <tbody id="selectpart">

                        <tr>
                            <td hidden><span name="partNumber">A12345</span></td>
                            <td class="mdl-data-table__cell--non-numeric">Part A</td>
                            <td><span id="db-stock1">1000</span></td>
                            <td>$<span id="db-price1">1000</span></td>
                        </tr>

                        <tr>
                            <td hidden><span name="partNumber">B12345</span></td>
                            <td class="mdl-data-table__cell--non-numeric">Part B</td>
                            <td><span id="db-stock1">1000</span></td>
                            <td>$<span id="db-price2">1000</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <!--          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button id="btn_add" type="button" class="btn btn-primary" data-dismiss="modal" disabled="disabled"
                            onclick="addToOrder();">Add
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/index.js"></script>
</body>

</html>
