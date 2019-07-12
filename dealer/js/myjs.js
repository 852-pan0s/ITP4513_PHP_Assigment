function openClose() {
    page.style.width = "100%"
}

function openClose() {
    page.style.width = "100%"
}

function countAmount(qty, price, total) {
    $(total).text($(qty).val() * $(price).text())
}

function countTotalAmount() {
    var total = 0;
    var shopping_partlist = partList.children;
    for (i = 0; i < shopping_partlist.length; i++) {
        if (shopping_partlist[i].classList.contains('is-selected')) {
            //console.log(shopping_partlist[i].children[1].children[0].textContent);
            total += parseInt(shopping_partlist[i].lastElementChild.lastElementChild.textContent);
        }
    }
    totalAmount.textContent = total;
}

function selectedCheckBox() {
    //console.log("HelloWorld!");
    var shopping_partlist = partList.children;
    for (i = 0; i < shopping_partlist.length; i++) {
        if (shopping_partlist[i].classList.contains('is-selected')) {
            //console.log(shopping_partlist[i].children[1].children[0].textContent);
            btn_buy.disabled = "";
            btn_delete.disabled = "";
            countTotalAmount();
            return;
        } else {
            btn_buy.disabled = "disabled";
            btn_delete.disabled = "disabled";
        }
    }
    countTotalAmount();
}

function init_btn_add() {
    var shopping_partlist = partList.children;
    for (i = 0; i < shopping_partlist.length; i++) {
        if (shopping_partlist[i].classList.contains('is-selected')) {
            console.log(shopping_partlist[i].textContent)
            btn_add.disabled = "";
            break;
        }
    }
}

function selectedCheckBoxFromDB() {
    //console.log("HelloWorld!");
    var shopping_partlist = selectpart.children;
    for (i = 0; i < shopping_partlist.length; i++) {
        if (shopping_partlist[i].children[0].children[0].children[0].checked) {
            //console.log(shopping_partlist[i].children[1].children[0].textContent);
            btn_add.disabled = "";
            return;
        } else {
            btn_add.disabled = "disabled";
        }
    }
}

function placeOrder() {
    var shopping_partlist = partlist.children;
    for (i = 0; i < shopping_partlist.length; i++) {
        if (shopping_partlist[i].classList.contains('is-selected')) {
            console.log(shopping_partlist[i].children[1].children[0].textContent);
            order.submit();
        }
    }
}

function isCheckedDefault(defaultAdd) {
    if (use_default_addr.checked) {
        address.value = defaultAdd;
        address.setAttribute('readonly', '');
    } else {
        address.removeAttribute('readonly');
    }
}


function showShoppingCart() {
    $(document).ready(function () {
        $('#shopping_cart').css('maxHeight', '2048px');
        $('#btn_new').css('display', 'none');
    });
}
