window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".dashboard-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";
});
