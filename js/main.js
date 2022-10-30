window.addEventListener("load", () => {
  // Toggle sidenav
  const toggleBtn = document.querySelector(".header-toggle");
  const logo = document.querySelector(".header-logo");
  const logoName = document.querySelector(".header-logo h6");
  const sideNav = document.querySelector(".sidenav");
  const sideNavLinks = document.querySelector(".sidenav ul");
  const mainDivContainer = document.querySelector(".main-content");
  const titleNav = document.querySelector(".nav-page");
  const table = document.querySelector(".tables");
  const alert = document.querySelector(".query-notif");
  const width = window.innerWidth > 0 ? window.innerWidth : screen.width;

  let bool = false;

  const toggleComponents = () => {
    toggleBtn.classList.toggle("spin");
    logo.classList.toggle("shrink");
    logoName.classList.toggle("remove");
    sideNav.classList.toggle("shrink");
    sideNavLinks.childNodes.forEach((element) => {
      if (
        element.classList == "dashboard-li flex-row" ||
        element.classList == "dashboard-li flex-row active" ||
        element.classList == "tables-li flex-row" ||
        element.classList == "tables-li flex-row active" ||
        element.classList == "menu-li flex-row" ||
        element.classList == "menu-li flex-row active" ||
        element.classList == "dirty-li flex-row" ||
        element.classList == "dirty-li flex-row active" ||
        element.classList == "inventory-li flex-row" ||
        element.classList == "inventory-li flex-row active" ||
        element.classList == "sales-li flex-row" ||
        element.classList == "sales-li flex-row active" ||
        element.classList == "admin-li flex-row" ||
        element.classList == "admin-li flex-row active"
      ) {
        if (bool != true) {
          element.childNodes[3].classList.toggle("remove");
        }
      } else {
        let x = element.classList;
      }
    });
    titleNav.classList.toggle("shrink");
    mainDivContainer.classList.toggle("shrink");
    table.classList.toggle("shrink");
  };

  toggleBtn.addEventListener("click", () => {
    toggleComponents();
  });

  if (width <= 820) {
    bool = true;
    toggleComponents(bool);
  }

  setTimeout(() => {
    alert.classList.add("hide");
  }, 3000);

  const time_stamp = document.querySelector(".last_timestamp");
  let time_now = document.querySelector(".time_now");

  let curr_time = parseInt(time_now.innerHTML) - parseInt(time_stamp.innerHTML);

  // time() - $_SESSION['last_login_timestamp']) > 60
  setInterval(() => {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./includes/user-contr.inc.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`&curr_time=${curr_time}`);
    console.log("timeout");
  }, 3000);
});
