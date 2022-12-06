window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".setting-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const addBtn = document.querySelector(".add-item-btn");

  const closeModalBtn = document.querySelectorAll(".close-add-form");

  const modalAdd = document.querySelector(".confirm-finish-cancel");
  const modalDelete = document.querySelector(".confirm-finish-cancel2");

  const inputId = document.querySelector(".input-table-id");
  const tableId = document.querySelector(".table-id");

  const tableId2 = document.querySelector(".table-id2");

  const deleteText = document.querySelector(".delete-body");
  const deleteHeading = document.querySelector(".oder-number2");

  addBtn.addEventListener("click", () => {
    overlay.classList.add("open");
    modalAdd.classList.add("open");
  });

  closeModalBtn.forEach((element) => {
    element.addEventListener("click", () => {
      overlay.classList.remove("open");
      modalAdd.classList.remove("open");
      modalDelete.classList.remove("open");
    });
  });

  inputId.addEventListener("keyup", (e) => {
    tableId.value = e.target.value;
  });

  let resetId = 0;

  const loadTable = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".setting-table").innerHTML = this.responseText;

        const deleteBtn = document.querySelectorAll(".delete-table-btn");

        deleteBtn.forEach((element) => {
          element.addEventListener("click", (e) => {
            overlay.classList.add("open");
            modalDelete.classList.add("open");
            tableId2.value = element.previousElementSibling.value;
            deleteText.innerHTML =
              "Do you want to delete table no." +
              element.previousElementSibling.value +
              "?";
          });
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
              // }, 2000);
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
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 5, true);
    xmlhttp.send();
  };

  setInterval(() => {
    loadTable();
  }, 1000);

  loadTable();

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);
});
