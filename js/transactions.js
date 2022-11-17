window.addEventListener("load", () => {
  let yourDate = new Date();
  yourDate.toLocaleString("en-US", {
    timeZone: "Asia/Manila",
  });
  let date = yourDate.toISOString().split("T")[0];
  let date2 = yourDate.toISOString().split("T")[0];

  // Update data every 1 second
  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".transaction-tbl-data").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=1", true);
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".export-transaction-tbl").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=3", true);
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".export-sales-report-tbl").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open("GET", "./includes/sales-view.inc.php?view=1", true);
    xmlhttp.send();

    // Get transaction for a selected date
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".transaction-tbl-data-date").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/transactions-view.inc.php?view=5&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();

    // Get transaction for a selected date for export
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".export-transaction-tbl-date").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/transactions-view.inc.php?view=6&date=" +
        date +
        "&date2=" +
        date2,
      true
    );
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".export-sales-report-tbl-date").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/sales-view.inc.php?view=2&date=" + date + "&date2=" + date2,
      true
    );
    xmlhttp.send();
  }, 1000);

  // Load initial table data
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      document.querySelector(".transaction-tbl-data").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=1", true);
  xmlhttp.send();

  // Load initial table data
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      document.querySelector(".transaction-tbl-data-date").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/transactions-view.inc.php?view=5&date=" +
      date +
      "&date2=" +
      date2,
    true
  );
  xmlhttp.send();

  // Load initial table data
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      document.querySelector(".export-transaction-tbl").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=3", true);
  xmlhttp.send();

  // Load initial table data
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      document.querySelector(".export-sales-report-tbl").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/sales-view.inc.php?view=1", true);
  xmlhttp.send();

  // Load initial data
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      document.querySelector(".export-sales-report-tbl-date").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/sales-view.inc.php?view=2&date=" + date + "&date2=" + date2,
    true
  );
  xmlhttp.send();

  // Get search input
  const searchTransction = document.querySelector(".search-transaction");
  const searchTransction2 = document.querySelector(".search-transaction-2");

  // Set boolean
  let isSearched = true;
  console.log(isSearched);

  // Search event
  searchTransction2.addEventListener("change", (e) => {
    date2 = e.target.value;
    console.log(date2);
  });
  searchTransction.addEventListener("change", (e) => {
    date = e.target.value;
    console.log(date);
    const transactionTbl = document.querySelector(".transaction-tbl-data");
    const transactionTblDate = document.querySelector(
      ".transaction-tbl-data-date"
    );

    if (date == "") {
      isSearched = false;
      transactionTbl.classList.remove("hide");
      transactionTblDate.classList.add("hide");
    } else {
      isSearched = true;
      transactionTbl.classList.add("hide");
      transactionTblDate.classList.remove("hide");

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          document.querySelector(".transaction-tbl-data-date").innerHTML =
            this.responseText;
        }
      };
      xmlhttp.open(
        "GET",
        "./includes/transactions-view.inc.php?view=5&date=" +
          date +
          "&date2=" +
          date2,
        true
      );
      xmlhttp.send();

      // Load transaction table with date
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          document.querySelector(".export-transaction-tbl-date").innerHTML =
            this.responseText;
        }
      };
      xmlhttp.open(
        "GET",
        "./includes/transactions-view.inc.php?view=6&date=" +
          date +
          "&date2=" +
          date2,
        true
      );
      xmlhttp.send();

      // Load sales report table with date
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          document.querySelector(".export-sales-report-tbl-date").innerHTML =
            this.responseText;
        }
      };
      xmlhttp.open(
        "GET",
        "./includes/sales-view.inc.php?view=2&date=" + date + "&date2=" + date2,
        true
      );
      xmlhttp.send();
    }
  });

  searchTransction.value = date;
  searchTransction2.value = date2;

  // Get button
  const exportTransaction = document.querySelector(".csvHtml5-transaction");
  const selectExport = document.querySelector("#transaction-export");

  let selectValue = selectExport.value;
  selectExport.addEventListener("change", (e) => {
    selectValue = e.target.value;
  });

  // Set month name for index number
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

  // Set file name
  let fileNameTransaction = month + " " + day + " Transactions";
  let fileNameSalesReport = month + " " + day + " Sales Report";

  // Create button event
  exportTransaction.addEventListener("click", () => {
    if (selectValue == "export-transaction-opt") {
      if (isSearched != true) {
        document
          .querySelector(".export-transaction-tbl")
          .classList.remove("hide");
        var table2excel = new Table2Excel({
          defaultFileName: fileNameTransaction,
        });

        table2excel.export(
          document.querySelectorAll(".export-transaction-tbl")
        );
        document.querySelector(".export-transaction-tbl").classList.add("hide");
      } else {
        document
          .querySelector(".export-transaction-tbl-date")
          .classList.remove("hide");
        var table2excel = new Table2Excel({
          defaultFileName: fileNameTransaction,
        });

        table2excel.export(
          document.querySelectorAll(".export-transaction-tbl-date")
        );
        document
          .querySelector(".export-transaction-tbl-date")
          .classList.add("hide");
      }
    } else {
      if (isSearched != true) {
        document
          .querySelector(".export-sales-report-tbl")
          .classList.remove("hide");
        var table2excel = new Table2Excel({
          defaultFileName: fileNameSalesReport,
        });

        table2excel.export(
          document.querySelectorAll(".export-sales-report-tbl")
        );
        document
          .querySelector(".export-sales-report-tbl")
          .classList.add("hide");
      } else {
        document
          .querySelector(".export-sales-report-tbl-date")
          .classList.remove("hide");
        var table2excel = new Table2Excel({
          defaultFileName: fileNameSalesReport,
        });

        table2excel.export(
          document.querySelectorAll(".export-sales-report-tbl-date")
        );
        document
          .querySelector(".export-sales-report-tbl-date")
          .classList.add("hide");
      }
    }
  });
});
