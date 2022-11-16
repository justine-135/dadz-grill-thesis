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

        for (let i = 1; i < 9; i++) {
          let timer = document.querySelector(`.table-${i}-time`);

          if (timer.getAttribute("started") != 1) {
            timer.innerHTML = "00:00:00";
          } else {
            let currentDate = new Date();
            let hour = currentDate.getHours();
            let minutes = currentDate.getMinutes();
            let second = currentDate.getSeconds();

            let hms = hour + ":" + minutes + ":" + second;
            let time = hms.split(":"); // convert to array
            // fetch
            let fhours = Number(time[0]);
            let fminutes = Number(time[1]);
            let fseconds = Number(time[2]);

            // calculate
            let timeValue;

            if (fhours > 0 && fhours <= 12) {
              timeValue = "" + fhours;
            } else if (fhours > 12) {
              timeValue = "" + (fhours - 12);
            } else if (fhours == 0) {
              timeValue = "12";
            }

            timeValue += fminutes < 10 ? ":0" + fminutes : ":" + fminutes; // get minutes
            timeValue += fseconds < 10 ? ":0" + fseconds : ":" + fseconds; // get seconds
            // timeValue += fhours >= 12 ? " P.M." : " A.M."; // get AM/PM

            const timeString = timeValue; // input string

            const arr = timeString.split(":"); // splitting the string by colon

            const seconds = arr[0] * 3600 + arr[1] * 60 + +arr[2]; // converting
            let timeEnd = timer.getAttribute("endtime");
            let duration = timeEnd - seconds;

            if (duration <= 0 || seconds >= timeEnd) {
              timer.innerHTML = "00:00:00";
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=1&id=${i}`,
                true
              );
              xmlhttp.send();
            } else {
              let durationValue = new Date(duration * 1000)
                .toISOString()
                .substring(11, 19);
              timer.innerHTML = durationValue;
            }
          }
        }
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

  setInterval(() => {
    loadTable();
    checkStatuses();
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
