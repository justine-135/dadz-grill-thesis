window.addEventListener("load", () => {
  const timer = setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "./includes/table-contr.inc.php?contr=" + 1, true);
    xmlhttp.send();
  }, 1000);

  // localStorage.openpages = Date.now();
  // window.addEventListener('storage', (e)=>{
  //     if (e.key == "openpages") {
  //         localStorage.page_available = Date.now();
  //     }
  //     if (e.key == "page_available") {
  //         clearInterval(timer);
  //     }
  // }, false)
});
