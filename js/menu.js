window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".menu-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const modalHead = document.querySelector(".action-modal-head");
  const menuLink = document.querySelector(".menu-link");
  const closeModal = document.querySelector(".action-btn-modal .head button");
  const tableId = document.querySelector("#table-id");

  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".waiter-tbl-data").innerHTML =
          this.responseText;
          const showBtn = document.querySelectorAll(".show-btn");

          showBtn.forEach((element) => {
            element.addEventListener("click", (e) => {
              modalHead.innerHTML =
                "Table no. " + element.previousElementSibling.innerHTML;
              overlay.classList.add("open");
        
              menuLink.href =
                "store.php?id=" + element.previousElementSibling.innerHTML;
        
              tableId.value = element.previousElementSibling.innerHTML;
            });
          });
      }
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user="+2, true);
    xmlhttp.send();
  }, 1000);

  closeModal.addEventListener("click", () => {
    overlay.classList.remove("open");
  });
});
