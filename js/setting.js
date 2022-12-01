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

  let arrValues = [];

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

  const timerFunction = () => {};

  const loadTable = (arr) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".setting-table").innerHTML = this.responseText;

        let tblStatus = document.querySelectorAll(".table-status");
      }

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

      for (let i = 1; i < 1000; i++) {
        let timer = document.querySelector(`.table-timer-col.table-${i}-time`);
        let bool = false;

        console.log(timer);
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
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 5, true);
    xmlhttp.send();
  };

  const loadTableNumbers = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".table-numbers-div").innerHTML =
          this.responseText;
      }

      let tableNumbersValue = document.querySelectorAll(".table-numbers");

      tableNumbersValue.forEach((element) => {
        arrValues.push(element.innerHTML);
      });

      loadTable(arrValues);
      arrValues = [];
    };
    xmlhttp.open("GET", "./includes/table-view.inc.php?user=" + 6, true);
    xmlhttp.send();
  };

  setInterval(() => {
    // loadTableNumbers();
    loadTable();
  }, 1000);

  loadTable();

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);

  //   loadTable();
  //   loadTableNumbers();
});
