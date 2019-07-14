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

  <script>
    function countTotalAmount() {
      var total = 0;
      var shopping_partlist = partlist.children;
      for (i = 0; i < shopping_partlist.length; i++) {
        //console.log(shopping_partlist[i].children[1].children[0].textContent);
        var qty = shopping_partlist[i].children[3].children[0].value;
        var price = shopping_partlist[i].children[4].children[0].textContent;
        shopping_partlist[i].lastElementChild.lastElementChild.textContent = qty * price;
        total += parseInt(shopping_partlist[i].lastElementChild.lastElementChild.textContent);
      }
      totalAmount.textContent = total;
    }
  </script>
</head>

<body class="mdc-typography" onload="countTotalAmount();">

  <header class="mdc-top-app-bar app-bar" id="app-bar">
    <div class="mdc-top-app-bar__row">
      <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <span class="mdc-top-app-bar__title">SMLCs Order System (Admin)</span>
      </section>
  
    </div>
  </header>

  <!--main content-->
  <div class="mdc-drawer-app-content mdc-top-app-bar--fixed-adjust">
    <main class="main-content mdc_typography mdc-typography--subtitle2" id="main-content">
        <div class="ui aligned basic segment">
         <div class="form_lar">
          <ul type="none" class="mdc_typography mdc-typography--headline6">
            <li>
              <div class="mdc-typography--headline5">Order ID: 1</div>
            </li>
            <li>Dealer name: John</li>
            <li class="mdc_typography mdc-typography--headline6">Delivery Address: Flat 14/A, Hello Road</li>
            <li>Order date: 2019-06-06</li>
            <li>Status: In Processing <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        Start Delivery
      </button> <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        Cancel Order
      </button></li>
          </ul>
          </div>
          
          <div class="form_lar">
          <div class="ui horizontal divider"></div>
          <table class="mdl-data-table mdl-js-data-tablemdl-shadow--2dp ">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">Part Number</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Total price</th>
              </tr>
            </thead>
            <tbody id="partlist">

              <tr>
                <td hidden><span name="partNumber">A12345</span></td>
                <td class="mdl-data-table__cell--non-numeric">A12345</td>
                <td>Part A</td>
                <td>
                  <input type="number" id="qty1" class="rightAlign" value="35" max="99999" min="1" readonly required>
                </td>
                <td>$<span id="price1">1000</span></td>
                <td>$<span id="total1">1000</span></td>
              </tr>

              <tr>
                <td hidden><span name="partNumber">B12345</span></td>
                <td class="mdl-data-table__cell--non-numeric">B12345</td>
                <td>Part B</td>
                <td>
                  <input type="number" id="qty2" class="rightAlign" value="4" max="99999" min="1" readonly required>
                </td>
                <td>$<span id="price2">1234</span></td>
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
           <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.close();" style="margin:24px 0;">
        Close
      </button>
        </div>
          </div>
        
    </main>
  </div>

  <script src="../dealer/js/index.js"></script>
</body></html>