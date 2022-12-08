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
  const profileLogout = document.querySelector(".profile-logout");

  let height = window.innerHeight > 0 ? window.innerHeight : screen.height;
  let width = window.innerWidth > 0 ? window.innerWidth : screen.width;
  setInterval(() => {
    height = window.innerHeight > 0 ? window.innerHeight : screen.height;
    width = window.innerWidth > 0 ? window.innerWidth : screen.width;
  }, 100);

  let bool = false;
  let bool2 = false;

  const toggleComponents = () => {
    toggleBtn.classList.toggle("spin");
    logo.classList.toggle("shrink");
    logoName.classList.toggle("remove");
    sideNav.classList.toggle("shrink");
    if (bool2 == true) {
      profileLogout.classList.toggle("hide");
    }
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
        element.classList == "sales-li flex-row" ||
        element.classList == "sales-li flex-row active" ||
        element.classList == "inventory-li flex-row" ||
        element.classList == "inventory-li flex-row active" ||
        element.classList == "admin-li flex-row" ||
        element.classList == "admin-li flex-row active" ||
        element.classList == "setting-li flex-row" ||
        element.classList == "setting-li flex-row active"
      ) {
        if (bool != true) {
          console.log(element);
          element.childNodes[3].classList.toggle("remove");
        }
      } else {
        let x = element.classList;
      }
    });
    titleNav.classList.toggle("shrink");
    mainDivContainer.classList.toggle("shrink");
    if (table != null) {
      table.classList.toggle("shrink");
    }
  };

  if (width <= 820) {
    bool = true;
    toggleComponents(bool);
  }

  toggleBtn.addEventListener("click", () => {
    if (width <= 530) {
      bool2 = true;
      toggleComponents(bool2);
    } else {
      bool2 = false;
      toggleComponents();
    }
    const legendStatus = document.querySelector(".legend-list");

    if (legendStatus != null) {
      legendStatus.classList.remove("open");
    }
  });

  setTimeout(() => {
    if (alert != null) {
      alert.classList.add("hide");
    }
  }, 3000);

  const time_stamp = document.querySelector(".last_timestamp");
  let time_now = document.querySelector(".time_now");

  let curr_time = parseInt(time_now.innerHTML) - parseInt(time_stamp.innerHTML);

  setInterval(() => {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./includes/user-contr.inc.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`&curr_time=${curr_time}`);
  }, 3000);
});
