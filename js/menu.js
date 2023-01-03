window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".menu-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const modalHead = document.querySelector(".action-modal-head");
  const closeModal = document.querySelector(".action-btn-modal .head button");
  const tableId = document.querySelector("#table-id");

  let resetId = 0;

  let statuses = [];
  const loadTable = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".waiter-tbl-data").innerHTML =
          this.responseText;
        const showBtn = document.querySelectorAll(".show-btn");
        const ordersBtn = document.querySelectorAll(".view-orders");

        let tblStatus = document.querySelectorAll(".table-status");

        tblStatus.forEach((element) => {
          statuses.push(element.innerHTML);
        });

        showBtn.forEach((element) => {
          element.addEventListener("click", (e) => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
              if (this.readyState == 4) {
                notAttended = this.responseText;
              }
            };
            xmlhttp.open(
              "GET",
              "./includes/orders-view.inc.php?view=" +
                3 +
                "&id=" +
                element.previousElementSibling.innerHTML,
              true
            );
            xmlhttp.send();

            id = element.previousElementSibling.innerHTML;
            modalHead.innerHTML =
              "Table no. " + element.previousElementSibling.innerHTML;
            overlay.classList.add("open");
            tableId.value = element.previousElementSibling.innerHTML;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
              if (this.readyState == 4) {
                document.querySelector(".series-orders-attend").innerHTML =
                  this.responseText;
              }
            };
            xmlhttp.open(
              "GET",
              "./includes/orders-view.inc.php?view=" + 2 + "&id=" + id,
              true
            );
            xmlhttp.send();
          });
        });

        ordersBtn.forEach((element) => {
          element.addEventListener("click", () => {});
        });

        let timer = document.querySelectorAll(`.table-timer-col`);

        timer.forEach((element) => {
          let timerVal = element;
          let connData = timerVal.parentElement.childNodes[5];
          let connText = timerVal.parentElement.childNodes[3].childNodes[0];
          let tableNumber =
            timerVal.parentElement.childNodes[1].childNodes[0].innerHTML;

          let counterVal = parseInt(connData.innerHTML);
          console.log(counterVal);
          if (counterVal > 0) {
            if (resetId != tableNumber) {
              resetId = tableNumber;
              connText.classList.remove("disconnected");
              connText.innerHTML = "Yes";
              // setTimeout(() => {
              //   console.log(tableNumber);
              //   var xmlhttp = new XMLHttpRequest();
              //   xmlhttp.open(
              //     "GET",
              //     `./includes/table-contr.inc.php?contr=2&id=${tableNumber}`,
              //     true
              //   );
              //   xmlhttp.send();
              // }, 2000);
              // setTimeout(() => {
              //   resetId = 0;
              // }, 3000);
            } else {
              connText.classList.remove("disconnected");
              connText.innerHTML = "Yes";
            }
          } else {
            connText.classList.add("disconnected");
            connText.innerHTML = "No";
          }
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
            let durationValue = new Date(duration * 1000)
              .toISOString()
              .substring(11, 19);

            if (duration <= 0 || seconds >= timeEnd || duration > 8100) {
              timerVal.innerHTML = "00:00:00";
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=1&id=${tableNumber}`,
                true
              );
              xmlhttp.send();
            } else {
              timerVal.innerHTML = durationValue;
            }
          }
        });
      }
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 2, true);
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
  checkStatuses();

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);

  closeModal.addEventListener("click", () => {
    overlay.classList.remove("open");
    document
      .querySelector(".action-btn-modal")
      .classList.remove("attended-table");
    document.querySelector(".btn-group").classList.remove("hide");
    document.querySelector(".series-orders-attend").classList.add("hide");
  });

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
