window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".dashboard-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  let interval = 800;

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
  },interval)

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
  },interval)

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".cancelled-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 3, true);
    xmlhttp.send();
  },interval)

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".success-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 4, true);
    xmlhttp.send();
  },interval);

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".occupied-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 5, true);
    xmlhttp.send();
  },interval);

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".unoccupied-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 6, true);
    xmlhttp.send();
  },interval);

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".call-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 7, true);
    xmlhttp.send();
  },interval);

  setInterval(()=>{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".dirty-number");
        
        totalOrders.innerHTML = this.responseText.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 8, true);
    xmlhttp.send();
  },interval);
});
