window.addEventListener("load", () => {
  let yourDate = new Date();
  yourDate.toLocaleString("en-US", {
    timeZone: "Asia/Manila",
  });
  let date = yourDate.toISOString().split("T")[0];
  let date2 = yourDate.toISOString().split("T")[0];

  setInterval(() => {
    loadData();
  }, 1000);

  const loadData = () => {
    console.log("hellow");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".compliance-tbl").innerHTML = this.responseText;
      }
    };
    xmlhttp.open(
      "GET",
      "./includes/users-view.inc.php?view=2&date=" + date + "&date2=" + date2,
      true
    );
    xmlhttp.send();
  };

  const searchDate = document.querySelector(".search-compliance");
  const searchDate2 = document.querySelector(".search-compliance-2");

  searchDate.addEventListener("change", (e) => {
    date = e.target.value;
    // if (date == "") {
    //   isSearched = false;
    //   historyTable.classList.remove("hide");
    //   historyTableDate.classList.add("hide");
    // } else {
    //   isSearched = true;
    //   historyTable.classList.add("hide");
    //   historyTableDate.classList.remove("hide");

    //   loadData();
    // }
    loadData();
  });

  searchDate2.addEventListener("change", (e) => {
    date2 = e.target.value;
    loadData();
  });

  searchDate.value = date;
  searchDate2.value = date2;

  loadData();
});
