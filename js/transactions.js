window.addEventListener("load", () => {
  let date;
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
      let totalSuccess = 0;
      let totalCancel = 0;

      let tdSuccess = document.querySelectorAll(".total-success-count");
      tdSuccess.forEach((element) => {
        let successValue = parseFloat(element.innerHTML);
        totalSuccess += successValue;
      });

      let tdCancel = document.querySelectorAll(".total-cancel-count");
      tdCancel.forEach((element) => {
        let cancelValue = parseFloat(element.innerHTML);
        totalCancel += cancelValue;
      });

      let tfootTotalSuccess = document.querySelector(".total-sold-success");
      tfootTotalSuccess.innerHTML = totalSuccess;

      let tfootTotalCancel = document.querySelector(".total-sold-cancel");
      tfootTotalCancel.innerHTML = totalCancel;
    };
    xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=4", true);
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
      "./includes/transactions-view.inc.php?view=5&date=" + date,
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
      "./includes/transactions-view.inc.php?view=6&date=" + date,
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
    let totalSuccess = 0;
    let totalCancel = 0;

    let tdSuccess = document.querySelectorAll(".total-success-count");
    tdSuccess.forEach((element) => {
      let successValue = parseFloat(element.innerHTML);
      totalSuccess += successValue;
    });

    let tdCancel = document.querySelectorAll(".total-cancel-count");
    tdCancel.forEach((element) => {
      let cancelValue = parseFloat(element.innerHTML);
      totalCancel += cancelValue;
    });

    let tfootTotalSuccess = document.querySelector(".total-sold-success");
    tfootTotalSuccess.innerHTML = totalSuccess;

    let tfootTotalCancel = document.querySelector(".total-sold-cancel");
    tfootTotalCancel.innerHTML = totalCancel;
  };
  xmlhttp.open("GET", "./includes/transactions-view.inc.php?view=4", true);
  xmlhttp.send();

  // Get search input
  const searchTransction = document.querySelector(".search-transaction");

  // Set boolean
  let isSearched = false;

  // Search event
  searchTransction.addEventListener("change", (e) => {
    date = e.target.value;
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
        "./includes/transactions-view.inc.php?view=5&date=" + date,
        true
      );
      xmlhttp.send();

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          document.querySelector(".export-transaction-tbl-date").innerHTML =
            this.responseText;
        }
      };
      xmlhttp.open(
        "GET",
        "./includes/transactions-view.inc.php?view=6&date=" + date,
        true
      );
      xmlhttp.send();
    }
  });

  // Get button
  const exportTransaction = document.querySelector(".csvHtml5-transaction");
  // const exportSalesReport = document.querySelector(".csvHtml5-sales-report");
  const selectExport = document.querySelector("#transaction-export");

  let selectValue = selectExport.value;
  selectExport.addEventListener("change", (e) => {
    selectValue = e.target.value;
    console.log(selectValue);
  });

  console.log(selectValue);

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
      document
        .querySelector(".export-sales-report-tbl")
        .classList.remove("hide");
      var table2excel = new Table2Excel({
        defaultFileName: fileNameSalesReport,
      });

      table2excel.export(document.querySelectorAll(".export-sales-report-tbl"));
      document.querySelector(".export-sales-report-tbl").classList.add("hide");
    }
  });
});
