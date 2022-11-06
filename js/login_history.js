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

  const exportBtn = document.querySelector(".csvHtml5");

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const d = new Date();
  let month = months[d.getMonth()];
  let day = d.getDate();

  let fileName = month + " " + day + " Login History";

  exportBtn.addEventListener("click", () => {
    var table2excel = new Table2Excel({
      defaultFileName: fileName,
    });
    table2excel.export(document.querySelectorAll(".loginhistory-table-info"));
  });
});
