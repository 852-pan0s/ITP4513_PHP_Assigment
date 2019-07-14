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
        <h2 class="mdc-typography--headline4">Edit Part</h2>
        <form action="" method="post">
          <ul type="none" class="mdc-typography--headline6">
            <li>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                <input class="mdl-textfield__input" name="partNumber" type="text" id="partName" value="1" readonly>
                <label class="mdl-textfield__label" for="partNumber">Part Number</label>
              </div>
            </li>
            <li>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                <input class="mdl-textfield__input" name="partName" type="text" id="partName" value="php-spareName" pattern="[a-zA-Z\d,.\-]{3,100}" maxlength="100" required readonly>
                <label class="mdl-textfield__label" for="partName">Part Name</label>
              </div>
            </li>
            <li>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                <input class="mdl-textfield__input" name="spareQuantity" type="number" id="stockQuantity" value="1000" max="99999999" min="0" required>
                <label class="mdl-textfield__label" for="stockQuantity">Stock Quantity</label>
              </div>
            </li>
            <li>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                <input class="mdl-textfield__input" name="sparePrice" type="number" id="stockPrice" value="1000" max="9999999" min="0" required>
                <label class="mdl-textfield__label" for="stockPrice">Stock Price</label>
              </div>
            </li>
            <li>
              <div class="mdc-select demo-width-class">
                <input type="hidden" name="enhanced-select">
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
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display: block;">
                <input class="mdl-textfield__input" name="email" type="text" id="email" value="php-spareName" maxlength="100" required readonly>
                <label class="mdl-textfield__label" for="email">email (who added the spare?)</label>
              </div>
            </li>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
        Update
      </button>
         <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="window.close();">
        Close
      </button>
          </ul>
        </form>
      </div>

    </main>
  </div>
  <script src="../dealer/js/mdc-dropdown.js"></script>
  <script src="../dealer/js/index.js"></script>
</body></html>
 
