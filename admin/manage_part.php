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

    <!--bootstrap-->
    <link rel="stylesheet" href="../dealer/css/bootstrap.min.css">
    <script src="../dealer/js/bootstrap.min.js"></script>

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
$link = "load_part.php";
if (isset($_GET['q'])) {
  if (strlen($_GET['q'] > 0)) {
    $link .= "?q={$_GET['q']}";
  }
}
?>

<script>
    page = 1;
    function changePage(cPage) {
        page = cPage;
        $("#orderlist").html("");
        $.ajax({
            type: 'get',
            url: '<?php echo $link;?>',
            dataType: 'json',
            success: function (result) {
                table = "";
                for (var i = page * 10 - 10; i < page * 10 && i < result.length; i++) {
                   // console.log(i);
                    var part = result[i];
                    var status = "a";
                    switch (part.stockStatus) {
                        case "1":
                            status = "Available";
                            break;
                        case "2":
                            status = "Unavailable";
                            break;
                    }
                    table += `
              <tr>
                <td class="mdl-data-table__cell--non-numeric">${part.partNumber}</td>
                <td class="mdl-data-table__cell--non-numeric">${part.partName}</td>
                <td class="mdl-data-table__cell--non-numeric">${part.stockQuantity}</td>
                <td class="mdl-data-table__cell--non-numeric">$${part.stockPrice}</td>
                <td class="mdl-data-table__cell--non-numeric">${part.email}</td>
                <td class="mdl-data-table__cell--non-numeric">${status}</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <a href="#${part.partNumber}" onclick="window.open('part.php?id=${part.partNumber}', '_blank', 'location=yes,height=1000,width=700,scrollbars=yes,status=yes')">Edit</a></td>
              </tr>`;
                }
                $("#orderlist").append($(table));
            },
            error: function (err) {
                console.log("error" + err);
            }
        });
    }

    $(document).ready(function () {
        $('#btn_search').on('click', function () {
            $keyword = $('#search').val(); //get the input text where id = search
            window.location.assign(`<?php echo $_SERVER['PHP_SELF'];?>?q=${$keyword}`)
        });

        $.ajax({
            type: 'get',
            url: '<?php echo $link;?>',
            dataType: 'json',
            success: function (result) {
                table = "";
                var totalPages = Math.ceil(result.length / 10.0); //every page shows 10 parts only. ceil for carry digit
                var pageHTML = ""; //used for page HTML page
                for (var i = 1; i <= totalPages; i++) {
                    pageHTML += `<li class="page-item"><a class="page-link" href="#page${i}" onclick="changePage(${i})">${i}</a></li>`;
                }
                $("#pageNo").append($(pageHTML)); //add page number
                changePage(1);
            },
            error: function (err) {
                console.log("error" + err);
            }
        });
    });
</script>

<?php
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

        <div class="form_ext">
            <h2 class="mdc-typography--headline4">Manage Parts</h2>
            <ol class="mdc-typography--headline6">
                <li>You can manage the part on this page.</li>
                <li>To edit parts, please press 'Edit'</li>
                <li>To add the new part, please press 'New Part'</li>
            </ol>
        </div>
        <div class="form_ext">
            <div class="ui center aligned basic segment mdc-typography">
                <div class="ui teal labeled icon button"
                     onclick="window.open('new_part.php', '_blank', 'location=yes,height=900,width=700,scrollbars=yes,status=yes')">
                    New Part
                    <i class="add icon"></i>
                </div>
                <div class="ui horizontal divider">
                    Or
                </div>
                <div class="ui left icon action input">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Part Number #" id="search">
                    <div class="ui blue submit button" id="btn_search">Search</div>
                </div>
            </div>


            <h2 class="mdc-typography--headline5">Result</h2>
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                <thead>
                <tr class="">
                    <th class="mdl-data-table__cell--non-numeric table_header">Part Number</th>
                    <th class="mdl-data-table__cell--non-numeric">Part Name</th>
                    <th class="mdl-data-table__cell--non-numeric">Stock Quantity</th>
                    <th class="mdl-data-table__cell--non-numeric">Stock Price</th>
                    <th class="mdl-data-table__cell--non-numeric">Email(Who added the part)</th>
                    <th class="mdl-data-table__cell--non-numeric">Stock Status</th>
                    <th class="mdl-data-table__cell--non-numeric">Action</th>
                </tr>
                </thead>
                <tbody id="orderlist">
                </tbody>
            </table>
            <nav aria-label="Page navigation" style="margin-top: 24px">
                <ul class="pagination justify-content-center" id="pageNo">
                </ul>
            </nav>
        </div>
    </main>
</div>

<script src="../dealer/js/index.js"></script>
</body>
</html>
