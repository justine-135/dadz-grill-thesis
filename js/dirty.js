window.addEventListener("load", () => {
  const dirtyLi = document.querySelector(".dirty-li");
  dirtyLi.classList.add("active");
  dirtyLi.querySelector(".inactive-link").className = "active-link";

  let statuses = [];
  let resetId = 0;

  const loadTable = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".cleaner-table").innerHTML = this.responseText;

        let tblStatus = document.querySelectorAll(".table-status");

        tblStatus.forEach((element) => {
          statuses.push(element.innerHTML);
        });
      }

      let timer = document.querySelectorAll(`.table-timer-col`);

      timer.forEach((element) => {
        let timerVal = element;
        let connData = timerVal.parentElement.childNodes[5];
        let connText = timerVal.parentElement.childNodes[3].childNodes[0];
        let tableNumber =
          timerVal.parentElement.childNodes[1].childNodes[0].innerHTML;

        let counterVal = parseInt(connData.innerHTML);
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
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 3, true);
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
