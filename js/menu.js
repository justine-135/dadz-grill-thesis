window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".menu-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const modalHead = document.querySelector(".action-modal-head");
  //const menuLink = document.querySelector(".menu-link");
  const closeModal = document.querySelector(".action-btn-modal .head button");
  const tableId = document.querySelector("#table-id");

  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".waiter-tbl-data").innerHTML =
          this.responseText;
        const showBtn = document.querySelectorAll(".show-btn");

        showBtn.forEach((element) => {
          element.addEventListener("click", (e) => {
            modalHead.innerHTML =
              "Table no. " + element.previousElementSibling.innerHTML;
            overlay.classList.add("open");
            tableId.value = element.previousElementSibling.innerHTML;
          });
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

            if (duration <= 0) {
              timer.innerHTML = "00:00:00";
              console.log("end");
            } else {
              console.log(duration);
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
  });

  const toggleLegendBtn = document.querySelector(".legend-btn");
  const legendStatus = document.querySelector(".legend-list");

  toggleLegendBtn.addEventListener("click", () => {
    legendStatus.classList.toggle("open");
  });
});
