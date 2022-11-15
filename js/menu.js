window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".menu-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const modalHead = document.querySelector(".action-modal-head");
  const closeModal = document.querySelector(".action-btn-modal .head button");
  const tableId = document.querySelector("#table-id");
  const attendBtn = document.querySelector("#attend");
  const attendBtn2 = document.querySelector("#attend2");
  let id;

  let notAttended;

  const form = document.querySelector("#waiter-form");

  // form.addEventListener("submit", (e) => {
  //   if (notAttended >= 1) {
  //     e.preventDefault();
  //   }
  // });

  // attendBtn.addEventListener("click", () => {
  //   document.querySelector(".action-btn-modal").classList.add("attended-table");
  //   if (notAttended >= 1) {
  //     document.querySelector(".btn-group").classList.add("hide");
  //     document.querySelector(".series-orders-attend").classList.remove("hide");
  //   } else {
  //     document
  //       .querySelector(".action-btn-modal")
  //       .classList.remove("attended-table");
  //     document.querySelector(".btn-group").classList.remove("hide");
  //     document.querySelector(".series-orders-attend").classList.add("hide");
  //   }
  // });

  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".waiter-tbl-data").innerHTML =
          this.responseText;
        const showBtn = document.querySelectorAll(".show-btn");
        const ordersBtn = document.querySelectorAll(".view-orders");

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

            console.log(notAttended);
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

        for (let i = 1; i < 9; i++) {
          let timer = document.querySelector(`.table-${i}-time`);
          let bool = false;

          if (timer.getAttribute("started") != 1) {
            timer.innerHTML = "00:00:00";
          } else {
            bool = false;
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
            console.log("time end: ", timeEnd);
            let duration = timeEnd - seconds;
            console.log(seconds);
            if (duration <= 0 || seconds >= timeEnd) {
              timer.innerHTML = "00:00:00";
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=1&id=${i}`,
                true
              );
              xmlhttp.send();
              console.log("bloew");
            } else {
              let durationValue = new Date(duration * 1000)
                .toISOString()
                .substring(11, 19);
              timer.innerHTML = durationValue;
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.open(
                "GET",
                `./includes/table-contr.inc.php?contr=2&id=${i}&duration=${durationValue}`,
                true
              );
              xmlhttp.send();
            }
          }
        }
      }
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 2, true);
    xmlhttp.send();
  }, 1000);

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
