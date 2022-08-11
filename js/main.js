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

  toggleBtn.addEventListener("click", () => {
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
        element.childNodes[3].classList.toggle("remove");
      } else {
        let x = element.classList;
      }
    });
    titleNav.classList.toggle("shrink");
    mainDivContainer.classList.toggle("shrink");
    table.classList.toggle("shrink");
  });
});
