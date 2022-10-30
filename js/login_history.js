window.addEventListener("load", () => {
  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".loginhistory-table-info").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/loginhistory-view.inc.php", true);
    xmlhttp.send();
  }, 1000);
});
