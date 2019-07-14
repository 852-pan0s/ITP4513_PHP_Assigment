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

    <!--bootstrap-->
    <!--  <link rel="stylesheet" href="../dealer/css/bootstrap.min.css">-->
    <!--  <script src="../dealer/js/bootstrap.min.js"></script>-->

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
if (!isset($_SESSION["email"]) || (!isset($_GET['orderID']))) {
  header("location:login.php");
} else {
  $sql = "SELECT o.orderID, o.dealerID, o.orderDate, o.deliveryAddress, o.status, d.name 
FROM orders o, dealer d WHERE o.orderID = '{$_GET['orderID']}' AND o.dealerID = d.dealerID";
  $rs = mysqli_query($conn, $sql); // Get dealer information
  if (mysqli_num_rows($rs) < 1) header("location:history.php");
  $rc = mysqli_fetch_assoc($rs); // Take the first row
  extract($rc);
  $step1 = "";
  $step2 = "";
  $step3 = "";
  switch ($status) {
    case 1:
      $strStatus = "In processing";
      $step1 = "active step";
      $step2 = "disabled step";
      $step3 = "disabled step";
      break;
    case 2:
      $step1 = "step";
      $step2 = "active step";
      $step3 = "disabled step";
      $strStatus = "Delivery";
      break;
    case 3:
      $step1 = "step";
      $step2 = "step";
      $step3 = "active step";
      $strStatus = "Completed";
      break;
    case 4:
      $step1 = "disabled step";
      $step2 = "disabled step";
      $step3 = "disabled step";
      $strStatus = "Canceled";
      break;
  }
}
$totalAmount = 0;
?>

<script>
    $(document).ready(function () {
        $("#btn_start").on('click', function () {
            window.location.assign("update_order.php?id=<?php echo $orderID;?>&status=2");
        });
        $("#btn_cancel").on('click', function () {
            window.location.assign("update_order.php?id=<?php echo $orderID;?>&status=4");
        });
    });
</script>

<header class="mdc-top-app-bar app-bar" id="app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <span class="mdc-top-app-bar__title">SMLCs Order System</span>
        </section>
    </div>
</header>

<!--main content-->
<div class="mdc-drawer-app-content mdc-top-app-bar--fixed-adjust">
    <main class="main-content mdc_typography mdc-typography--subtitle2" id="main-content">
        <div class="ui aligned basic segment">
            <div class="form_lar">
                <h2 class="mdc-typography--headline5">Step</h2>
                <div class="my--mainContent-header">
                    <!--status: step active disabled-->
                    <div class="ui steps">
                        <div class="<?php echo $step1; ?>">
                            <i class="cart arrow down icon"></i>
                            <div class="content">
                                <div class="title">Place Order</div>
                                <div class="description">Add parts and place your order.</div>
                            </div>
                        </div>
                        <div class="<?php echo $step2; ?>">
                            <i class="truck icon"></i>
                            <div class="content">
                                <div class="title">Delivery</div>
                                <div class="description">Your ordered parts are delivering.</div>
                            </div>
                        </div>
                        <div class="<?php echo $step3; ?>">
                            <i class="info icon"></i>
                            <div class="content">
                                <div class="title">Confirm</div>
                                <div class="description">Receive the part.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form_lar">
                <h2 class="mdc-typography--headline5" id="action">Available Action</h2>
              <?php if (isset($_GET["ok"])) { ?>
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <div class="success-msg">Update Successfully!</div>
                  </div>
              <?php } else if (isset($_GET["fail"])) { ?>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <div class="error-msg">Update Fail! Another admin did it before.</div>
                </div>

                  <?php }
                  if ($status == "1") { ?>

                      <button id="btn_start"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                          Start Delivery
                      </button>
                  <?php }
                  if ($status != "4") { ?>
                      <button id="btn_cancel"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                          Cancel Order
                      </button>
                  <?php } ?>

            </div>
            <div class="form_lar">
                <ul type="none" class="mdc_typography mdc-typography--headline6">
                    <li>
                        <div class="mdc-typography--headline5">Order ID: <?php echo $orderID; ?></div>
                    </li>
                    <li>Dealer name: <?php echo $name; ?></li>
                    <li class="mdc_typography mdc-typography--headline6">Delivery
                        Address: <?php echo $deliveryAddress; ?></li>
                    <li>Order date: <?php echo $orderDate; ?></li>
                    <li>Status: <?php echo $strStatus; ?></li>
                </ul>
            </div>

            <div class="form_lar">
                <div class="ui horizontal divider"></div>
                <table class="mdl-data-table mdl-js-data-tablemdl-shadow--2dp ">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric left">Part Number</th>
                        <th class="mdl-data-table__cell--non-numeric">Part Name</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Total price</th>
                    </tr>
                    </thead>
                    <tbody id="partlist">
                    <?php
                    $sql = "SELECT orderID, op.partNumber, quantity, op.price, p.partName FROM orderpart op, part p WHERE orderID = $orderID AND op.partNumber = p.partNumber";
                    $rs = mysqli_query($conn, $sql);
                    while ($rc = mysqli_fetch_assoc($rs)) {
                      extract($rc);
                      $totalPrice = $quantity * $price;
                      $totalAmount += $totalPrice;
                      $orderline = <<<HTML_CODE
                    <tr>
                        <td hidden><span name="partNumber">$partNumber</span></td>
                        <td class="mdl-data-table__cell--non-numeric">$partNumber</td>
                        <td class="mdl-data-table__cell--non-numeric">$partName</td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <input type="number" id="qty1" class="mdl-data-table__cell--non-numeric center" value="$quantity" readonly>
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">$$price</span></td>
                        <td class="mdl-data-table__cell--non-numeric">$$totalPrice</span></td>
                    </tr>
HTML_CODE;
                      echo $orderline;
                    }
                    ?>
                    </tbody>
                </table>
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Total Amount</th>
                        <th>$<span id="totalAmount"><?php echo $totalAmount ?></span></th>
                    </tr>
                    </thead>
                </table>
                <button type="button"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                        onclick="window.close();" style="margin:24px 0;">
                    Close
                </button>
            </div>
        </div>
    </main>
</div>

</body>
</html>