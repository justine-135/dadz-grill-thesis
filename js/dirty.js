window.addEventListener("load", () => {
    const dirtyLi = document.querySelector(".dirty-li");
    dirtyLi.classList.add("active");
    dirtyLi.querySelector(".inactive-link").className = "active-link";

    setInterval(() => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4) {
            document.querySelector(".cleaner-table").innerHTML =
              this.responseText;
    
          }
        };
        xmlhttp.open("GET", "./includes/table-view.inc.php?user="+3, true);
        xmlhttp.send();
      }, 1000);
});