window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".sales-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const cancelBtn = document.querySelectorAll(".cancel-btn");
  const overlay = document.querySelector(".overlay");
  const closeBtn = document.querySelector(".close-add-form");
  const orderNumber = document.querySelector(".order-number");
  const orderId = document.querySelector(".table-order");

  closeBtn.addEventListener("click", () => {
    overlay.classList.remove("open");
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

  const loadOrders = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".orders-list").innerHTML = this.responseText;
        const finishBtn = document.querySelectorAll(".finish-btn");
        finishBtn.forEach((element) => {
          element.addEventListener("click", () => {
            overlay.classList.add("open");
            let id =
              element.parentElement.parentElement.childNodes[1].innerHTML;
            orderNumber.innerHTML = "Finish order - " + id;
            orderId.value =
              element.parentElement.parentElement.childNodes[3].innerHTML;

            confirmOrder(id);
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
