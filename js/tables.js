window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".tables-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const tableNumber = document.querySelector(".order-tbl-number");
  const closeOrderBtn = document.querySelector(".close-order-btn");

  let statuses = [];

  const loadTable = () => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".cashier-tbl-data").innerHTML =
          this.responseText;
        const viewOrderBtn = document.querySelectorAll(".view-order-btn");

        viewOrderBtn.forEach((element) => {
          element.addEventListener("click", () => {
            let tbl = element.previousElementSibling.value;
            overlay.classList.add("open");
            tableNumber.innerHTML = "Table " + tbl + " - Order";
            infoServer(tbl);
          });
        });

        closeOrderBtn.addEventListener("click", () => {
          overlay.classList.remove("open");
        });

        let tblStatus = document.querySelectorAll(".table-status");

        tblStatus.forEach((element) => {
          statuses.push(element.innerHTML);
        });

        let timer = document.querySelectorAll(`.table-timer-col`);

        timer.forEach((element) => {
          let timerVal = element;
          let connData = timerVal.parentElement.childNodes[5];
          let connText = timerVal.parentElement.childNodes[3].childNodes[0];
          let tableNumber =
            timerVal.parentElement.childNodes[1].childNodes[0].innerHTML;

          let counterVal = parseInt(connData.innerHTML);
          if (counterVal > 0) {
            connText.classList.remove("disconnected");
            connText.innerHTML = "Yes";
            setTimeout(() => {
              console.log("disconnect");
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=2&id=${tableNumber}`,
                true
              );
              xmlhttp.send();
            }, 6000);
          } else {
            connText.classList.add("disconnected");
            connText.innerHTML = "No";
          }

          console.log();

          const form = timerVal.parentElement.childNodes[16].childNodes[1];

          form.addEventListener("submit", (e) => {
            let text = "Do you want to continue?";
            if (confirm(text) != true) {
              e.preventDefault();
            }
          });

          if (timerVal.getAttribute("started") != 1) {
            timerVal.innerHTML = "00:00:00";
          } else {
            bool = false;
            let currentDate = new Date();
            let hour = currentDate.getHours();
            let minutes = currentDate.getMinutes();
            let second = currentDate.getSeconds();

            let hms = hour + ":" + minutes + ":" + second;
            let time = hms.split(":");
            let fhours = Number(time[0]);
            let fminutes = Number(time[1]);
            let fseconds = Number(time[2]);

            let timeValue;

            if (fhours > 0 && fhours <= 12) {
              timeValue = "" + fhours;
            } else if (fhours > 12) {
              timeValue = "" + (fhours - 12);
            } else if (fhours == 0) {
              timeValue = "12";
            }

            timeValue += fminutes < 10 ? ":0" + fminutes : ":" + fminutes;
            timeValue += fseconds < 10 ? ":0" + fseconds : ":" + fseconds;

            const timeString = timeValue;

            const arr = timeString.split(":");

            const seconds = arr[0] * 3600 + arr[1] * 60 + +arr[2];
            let timeEnd = timerVal.getAttribute("endtime");
            let duration = timeEnd - seconds;

            if (duration <= 0 || seconds >= timeEnd) {
              timerVal.innerHTML = "00:00:00";
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=1&id=${tableNumber}`,
                true
              );
              xmlhttp.send();
            } else {
              let durationValue = new Date(duration * 1000)
                .toISOString()
                .substring(11, 19);
              timerVal.innerHTML = durationValue;
              // var xmlhttp = new XMLHttpRequest();
              // xmlhttp.open(
              //   "GET",
              //   `./includes/table-contr.inc.php?contr=2&id=${tableNumber}&duration=${durationValue}`,
              //   true
              // );
              // xmlhttp.send();
            }
          }
        });
      }
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 1, true);
    xmlhttp.send();
  };

  const infoServer = (table) => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".order-information").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/orders-view.inc.php?view=" + 1 + "&id=" + table,
      true
    );
    xmlhttp.send();
  };

  const checkStatuses = () => {
    if (statuses.includes("Need assistance")) {
      document.querySelector(".alert-warning-notify").classList.remove("hide");
    } else {
      document.querySelector(".alert-warning-notify").classList.add("hide");
    }
    statuses = [];
  };

  const loadConnection = () => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".order-information").innerHTML =
          this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/table-contr.inc.php?view=" + 1 + "&id=" + table,
      true
    );
    xmlhttp.send();
  };

  setInterval(() => {
    loadTable();
    checkStatuses();
    loadConnection();
  }, 1000);

  loadTable();
  infoServer();
  checkStatuses();

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);

  const toggleLegendBtn = document.querySelector(".legend-btn");
  const toggleLegendBtn2 = document.querySelector(".legend-btn2");

  const legendStatus = document.querySelector(".legend-list");

  toggleLegendBtn.addEventListener("click", () => {
    legendStatus.classList.toggle("open");
  });

  toggleLegendBtn2.addEventListener("click", () => {
    legendStatus.classList.toggle("open");
  });
});
