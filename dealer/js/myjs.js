isOpen = false;

function adjustIframe() {
//  if (!isOpen) {
//    isOpen = true;
//    //
//    page.style.width = "82%"
//  } else {
//    isOpen = false;
//    page.style.width = "100%"
//  }
}

function openClose() {
  console.log("Hi");
  isOpen = false;
  page.style.width = "100%"
}

function openClose() {
  console.log("Hi");
  isOpen = false;
  page.style.width = "100%"
}

function countAmount(qty, price, total) {
  total.textContent = qty.value * price.textContent;
}

function countTotalAmount() {
  var total = 0;
  var shopping_partlist = partlist.children;
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
  var shopping_partlist = partlist.children;
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

function init_btn_add(){
  btn_add.disabled = "disabled";
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

function addToOrder(){
  db_list_head.children[0].children[0].children[0].classList.remove('is-checked');
  db_list_head.children[0].children[0].children[0].children[0].checked = false;
  var shopping_partlist = selectpart.children;
  for (i = 0; i < shopping_partlist.length; i++) {
    if (shopping_partlist[i].children[0].children[0].children[0].checked) {
      shopping_partlist[i].children[0].children[0].classList.remove('is-checked');
    shopping_partlist[i].classList.remove('is-selected');
     shopping_partlist[i].children[0].children[0].children[0].checked = false;
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

function isCheckedDefault() {
  if (use_default_addr.checked) {
    address.value = "php-address";
    address.setAttribute('readonly', '');
  } else {
    address.removeAttribute('readonly');
  }
}

function showShoppingCart() {
  shopping_cart.style.maxHeight = "2048px";
  btn_new.style.display = "none";
}
