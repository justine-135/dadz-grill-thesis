window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".sales-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const closeBtn = document.querySelectorAll(".close-add-form");
  const orderNumber = document.querySelector(".order-number");
  const orderNumber2 = document.querySelector(".order-number2");

  const orderId = document.querySelector(".order-num");
  const orderId2 = document.querySelector(".order-num2");

  const tableId = document.querySelector(".table-order");
  const tableId2 = document.querySelector(".table-order2");

  const finishDiv = document.querySelector(".confirm-finish-cancel");
  const cancelDiv = document.querySelector(".confirm-finish-cancel2");

  closeBtn.forEach(element => {
    element.addEventListener("click", () => {
      overlay.classList.remove("open");
    });
  });

  const confirmOrder = (id) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".order-confirm-finish").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/purchase-view.inc.php?id=" + id, true);
    xmlhttp.send();
  };

  const cancelOrder = (id) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".order-confirm-cancel").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/purchase-view.inc.php?id=" + id, true);
    xmlhttp.send();
  };

  const loadOrders = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".orders-list").innerHTML = this.responseText;

        const finishBtn = document.querySelectorAll(".finish-btn");
        const cancelBtn = document.querySelectorAll(".cancel-btn");

        finishBtn.forEach((element) => {
          element.addEventListener("click", () => {
            finishDiv.classList.add("open");
            cancelDiv.classList.remove("open");
            overlay.classList.add("open");
            let id =
              element.parentElement.parentElement.childNodes[1].innerHTML;
            orderNumber.innerHTML = "Finish order - " + id;
            orderId.value =
              element.parentElement.parentElement.childNodes[1].innerHTML;
            tableId.value = element.parentElement.parentElement.childNodes[3].innerHTML;

            console.log(element.parentElement.parentElement.childNodes[3].innerHTML);
            confirmOrder(id);
          });
        });

        cancelBtn.forEach((element) => {
          element.addEventListener("click", () => {
            overlay.classList.add("open");
            cancelDiv.classList.add("open");
            finishDiv.classList.remove("open");
            let id =
              element.parentElement.parentElement.childNodes[1].innerHTML;
            orderNumber2.innerHTML = "Cancel order - " + id;
            orderId2.value =
              element.parentElement.parentElement.childNodes[1].innerHTML;
              tableId2.value = element.parentElement.parentElement.childNodes[3].innerHTML;

            cancelOrder(id);
          });
        });
      }
    };
    xmlhttp.open("GET", "./includes/purchase-view.inc.php?view="+1, true);
    xmlhttp.send();
  };

  setInterval(() => {
    loadOrders();
  }, 1000);
});
