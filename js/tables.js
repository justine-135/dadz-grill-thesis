window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".tables-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const tableNumber = document.querySelector(".order-tbl-number");
  const closeOrderBtn = document.querySelector(".close-order-btn");

  const infoServer = (table) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".order-information").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/orders-view.inc.php?id=" + table, true);
    xmlhttp.send();
  };

  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".cashier-tbl-data").innerHTML =
          this.responseText;
        const viewOrderBtn = document.querySelectorAll(".view-order-btn");

        viewOrderBtn.forEach((element) => {
          element.addEventListener("click", () => {
            let tbl = element.previousElementSibling.value;
            overlay.classList.add("open");
            tableNumber.innerHTML = "Table " + tbl + " - Order";
            infoServer(tbl);
          });
        });

        closeOrderBtn.addEventListener("click", () => {
          overlay.classList.remove("open");
        });
      }
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 1, true);
    xmlhttp.send();
  }, 1000);

  const toggleLegendBtn = document.querySelector(".legend-btn");
  const legendStatus = document.querySelector(".legend-list");

  toggleLegendBtn.addEventListener("click", () => {
    legendStatus.classList.toggle("open");
  });
});
