window.addEventListener("load", () => {
  let id = document.querySelector("#bill-id");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const totalOrders = document.querySelector(".bill-tbl-data");

      totalOrders.innerHTML = this.responseText;

      let billInput = document.querySelector("#bill-input");
      let amountPaid = document.querySelector("#amount-paid");
      let amountChange = document.querySelector("#amount-change");
      let amountTotal = document.querySelector("#amount-total");

      let id = document.querySelector("#id");
      let totalInput = document.querySelector("#total");
      let changeInput = document.querySelector("#change");
      let paymentInput = document.querySelector("#payment");
      console.log(id);

      let totalPriceValue = parseFloat(amountTotal.innerHTML)
        .toFixed(2)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

      amountTotal.innerHTML = totalPriceValue;
      totalInput.value = totalPriceValue;

      let sub = 0;

      billInput.addEventListener("keyup", (e) => {
        e.target.value = e.target.value
          .replace(/[^0-9.]/g, "")
          .replace(/(\..*?)\..*/g, "$1")
          .replace(/^0[^.]/, "0");

        let amountPaidValue = parseFloat(e.target.value)
          .toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        paymentInput.value = amountPaidValue;

        if (!e.target.value) {
          amountPaidValue = 0;
          paymentInput.value = 0;
        }

        amountPaid.innerHTML = amountPaidValue;

        sub = parseFloat(e.target.value) - parseFloat(amountTotal.innerHTML);
        if (isNaN(sub)) {
          amountChange.innerHTML = 0;
          changeInput.value = 0;
        } else {
          amountChange.innerHTML = sub
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          changeInput.value = sub
            .toFixed(2)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // let div = document.createElement("div");
        // div.innerHTML = "This is receipt";
      });

      const receipt = document.querySelector("#receipt");
      const printBtn = document.querySelector("#print");

      printBtn.addEventListener("click", () => {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
          let receiptPaper = document.createElement("div");
          receiptPaper.innerHTML = this.responseText;
          let windowPrint = window.open("", "", "height=auto,width=500");
          windowPrint.document.write(receiptPaper.innerHTML);
          windowPrint.print();
        };
        xhttp.open("POST", "./includes/receipt-view.inc.php");
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send(
          `&id=${id.value}&change=${changeInput.value}&payment=${paymentInput.value}&total=${totalInput.value}`
        );
      });
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/transactions-view.inc.php?view=2&id=" + id.value,
    true
  );
  xmlhttp.send();
});
