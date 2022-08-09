window.addEventListener("load", ()=>{
    setInterval(()=>{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4) {
            document.querySelector(".transaction-tbl-data").innerHTML =
              this.responseText;
          }
        };
        xmlhttp.open("GET", "./includes/transactions-view.inc.php", true);
        xmlhttp.send();
    }, 2000)
})