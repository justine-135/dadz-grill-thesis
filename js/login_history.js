window.addEventListener("load", () => {
  let yourDate = new Date();
  let date = yourDate.toISOString().split("T")[0];
  let date2 = yourDate.toISOString().split("T")[0];

  setInterval(() => {
    loadData();
  }, 1000);

  const loadData = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".loginhistory-table-info").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/loginhistory-view.inc.php?view=" + 1, true);
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".loginhistory-table-info-date").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/loginhistory-view.inc.php?view=" +
        2 +
        "&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();
  };

  // Get search input
  const searchHistory = document.querySelector(".search-login-history");
  const searchHistory2 = document.querySelector(".search-login-history-2");

  // Get tables
  const historyTable = document.querySelector(".loginhistory-table-info");
  const historyTableDate = document.querySelector(
    ".loginhistory-table-info-date"
  );

  // Set boolean
  let isSearched = true;
  console.log(isSearched);
  // Search event
  searchHistory.addEventListener("change", (e) => {
    date = e.target.value;
    if (date == "") {
      isSearched = false;
      historyTable.classList.remove("hide");
      historyTableDate.classList.add("hide");
    } else {
      isSearched = true;
      historyTable.classList.add("hide");
      historyTableDate.classList.remove("hide");

      loadData();
    }
  });

  searchHistory2.addEventListener("change", (e) => {
    date2 = e.target.value;
  });

  searchHistory.value = date;
  searchHistory2.value = date2;

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
    if (isSearched != true) {
      var table2excel = new Table2Excel({
        defaultFileName: fileName,
      });
      table2excel.export(document.querySelectorAll(".loginhistory-table-info"));
    } else {
      var table2excel = new Table2Excel({
        defaultFileName: fileName,
      });
      table2excel.export(
        document.querySelectorAll(".loginhistory-table-info-date")
      );
    }
  });

  loadData();
});
