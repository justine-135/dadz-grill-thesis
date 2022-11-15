window.addEventListener("load", () => {
  let yourDate = new Date();
  yourDate.toLocaleString("en-US", {
    timeZone: "Asia/Manila",
  });
  let date = yourDate.toISOString().split("T")[0];
  let date2 = yourDate.toISOString().split("T")[0];

  const dashboardLi = document.querySelector(".dashboard-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  let interval = 800;

  setInterval(() => {
    loadData();
  }, interval);

  const loadData = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".sales-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/dashboard-view.inc.php?grid=" +
        1 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".order-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/dashboard-view.inc.php?grid=" +
        2 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".cancelled-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/dashboard-view.inc.php?grid=" +
        3 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".success-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/dashboard-view.inc.php?grid=" +
        4 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".occupied-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 5, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".unoccupied-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 6, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".call-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 7, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".dirty-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 8, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".total-crews-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 9, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(
          ".total-active-crews-number"
        );

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 10, true);
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".total-served-number");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/dashboard-view.inc.php?grid=" +
        11 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        const totalOrders = document.querySelector(".crew-role");

        totalOrders.innerHTML = this.responseText
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    };
    xmlhttp.open("GET", "./includes/dashboard-view.inc.php?grid=" + 12, true);
    xmlhttp.send();
  };

  // Get search input
  const searchDashboard = document.querySelector(".search-dashboard");
  const searchDashboard2 = document.querySelector(".search-dashboard-2");

  // Set boolean
  let isSearched = true;
  console.log(isSearched);

  // Search event
  searchDashboard2.addEventListener("change", (e) => {
    date2 = e.target.value;
    loadData();
    console.log(date2);
  });
  searchDashboard.addEventListener("change", (e) => {
    date = e.target.value;
    loadData();
    console.log(date);
  });

  searchDashboard.value = date;
  searchDashboard2.value = date2;

  loadData();
});
