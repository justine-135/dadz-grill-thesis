window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".dashboard-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".sales-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 1, true);
    xmlhttp.send();
  },1000)

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".order-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 2, true);
    xmlhttp.send();
  },1000)
});
