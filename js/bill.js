window.addEventListener("load", () => {
  let id = document.querySelector("#bill-id");
  const alert = document.querySelector(".query-notif");

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
      let tableId = document.querySelector("#table").value;
      let totalInput = document.querySelector("#total");
      let changeInput = document.querySelector("#change");
      let paymentInput = document.querySelector("#payment");
      let totalPriceValue;
      let priceValue;
      let itemPrices2;
      // let priceInputTmps = document.querySelectorAll(".price-input-tmp");
      let quantity;

      const calculateTotalBill = () => {
        totalPriceValue = 0;
        let itemPrices = document.querySelectorAll(".item-prices");

        itemPrices.forEach((e) => {
          let prices = parseFloat(e.innerHTML);
          // let fixprices = prices.toFixed(2);

          totalPriceValue = parseFloat(totalPriceValue) + parseFloat(prices);
        });

        amountTotal.innerHTML = totalPriceValue
          .toFixed(2)
          .toString()
          .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        totalInput.value = totalPriceValue;
      };

      calculateTotalBill();

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

        sub =
          parseFloat(e.target.value) -
          parseFloat(amountTotal.innerHTML.replace(",", ""));

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
      });

      const printBtn = document.querySelector("#print");
      const saveBtn = document.querySelector("#save");

      printBtn.addEventListener("click", () => {
        if (
          parseFloat(paymentInput.value.replace(",", "")) >=
          parseFloat(totalInput.value.replace(",", ""))
        ) {
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
            `&print=print&id=${id.value}&change=${changeInput.value}&payment=${paymentInput.value}&total=${totalInput.value}`
          );
        }
      });

      saveBtn.addEventListener("click", () => {
        if (
          parseFloat(paymentInput.value.replace(",", "")) >=
          parseFloat(totalInput.value.replace(",", ""))
        ) {
          alert.classList.remove("hide");
          alert.classList.remove("alert-danger");
          alert.classList.add("alert-success");
          alert.innerHTML = "Order has been paid.";

          const xhttp = new XMLHttpRequest();
          xhttp.open("POST", "./includes/transactions-contr.inc.php");
          xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhttp.send(
            `&save=save&table_id=${tableId}&id=${id.value}&change=${changeInput.value}&payment=${paymentInput.value}&total=${totalInput.value}`
          );
        } else {
          alert.classList.remove("hide");
          alert.classList.remove("alert-success");
          alert.classList.add("alert-danger");
          alert.innerHTML = "Payment process failed.";
        }
      });

      let priceAfterDiscount;
      const loadSelect = () => {
        let selectDiscount = document.querySelectorAll(".select-discount");
        selectDiscount.forEach((element) => {
          let discount = element;

          discount.addEventListener("change", (e) => {
            let discountLvl = parseInt(discount.value);
            priceAfterDiscount =
              discount.parentElement.parentElement.parentElement.parentElement
                .parentElement.childNodes[9].childNodes[1];

            // let tmpPrice =
            //   discount.parentElement.parentElement.parentElement.parentElement
            //     .parentElement.childNodes[11].childNodes[1].innerHTML;

            let tmpPrice =
              discount.parentElement.parentElement.parentElement.parentElement
                .parentElement.childNodes[3].innerHTML;

            let priceInputTmps =
              discount.parentElement.parentElement.parentElement.parentElement
                .parentElement.childNodes[13];

            console.log(priceInputTmps);

            let selectInputPrice = discount.nextElementSibling.value;

            let selectDiscountId = discount.getAttribute("id");

            // 1 = disabled
            // 2 = senior
            // 3 = bday celebrant
            // 4 = 3yrs old below
            // 5 = 4-6 yrs old

            let calculate = 0;
            switch (discountLvl) {
              case 0:
                discount.nextElementSibling.value = tmpPrice;
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = tmpPrice;
                break;
              case 1:
                calculate = parseFloat(tmpPrice) * 0.2;
                discount.nextElementSibling.value =
                  parseFloat(tmpPrice) - calculate.toFixed(2);
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = parseFloat(tmpPrice) - calculate.toFixed(2);
                break;
              case 2:
                calculate = parseFloat(tmpPrice) * 0.2;
                discount.nextElementSibling.value =
                  parseFloat(tmpPrice) - calculate.toFixed(2);
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = parseFloat(tmpPrice) - calculate.toFixed(2);
                break;
              case 3:
                discount.nextElementSibling.value = 0;
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = 0;
                break;
              case 4:
                discount.nextElementSibling.value = 0;
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = 0;
                break;
              case 5:
                discount.nextElementSibling.value = parseFloat(tmpPrice) / 2;
                priceInputTmps.querySelector(
                  `.price-input-tmp-${selectDiscountId}`
                ).value = parseFloat(tmpPrice) / 2;
                break;

              default:
                break;
            }

            priceValue = 0;
            priceInputTmps.childNodes.forEach((element) => {
              let priceValues = element;

              if (priceValues.value != undefined) {
                priceValue =
                  parseFloat(priceValue) + parseFloat(priceValues.value);
              }

              console.log(priceValues.value);
            });

            priceAfterDiscount.innerHTML = priceValue
              .toFixed(2)
              .toString()
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            calculateTotalBill();
          });
        });
      };

      loadSelect();

      const addDiscountBtn = document.querySelectorAll(".add-discount");

      let selectId = 0;
      addDiscountBtn.forEach((element) => {
        element.addEventListener("click", () => {
          itemPrices2 =
            element.parentElement.parentElement.parentElement.childNodes[11]
              .childNodes[0].innerHTML;

          quantity =
            element.parentElement.parentElement.parentElement.childNodes[5]
              .innerHTML;

          console.log(itemPrices2);

          let allSelectDiv = element.previousElementSibling;
          let selectDiv = element.previousElementSibling.childNodes[1];

          if (allSelectDiv.childElementCount >= quantity) {
            window.alert("Reached max discount");
          } else {
            selectId += 1;
            const clone = selectDiv.cloneNode(true);
            const createSelect = document.createElement("div");
            createSelect.setAttribute("class", "flex-row");
            const createSelectContent = `
                <select class="form-select form-select select-discount select-discount-${selectId} mb-1" name="" id="${selectId}">
                    <option value="0">None</option>
                    <option value="1">Person with disability</option>
                    <option value="2">Senior</option>
                    <?php
                    if (strpos($result[$i], "Set C") !== false) {
                    ?>
                    <option value="3">Birthday celebrant</option>
                    <?php } ?>
                    <option value="4">3 yrs old below</option>
                    <option value="5">4-6 yrs old</option>
                </select>
                <input class="new-price new-price-${selectId}" type="text" name="" id="" value=${itemPrices2} hidden>
            `;
            createSelect.innerHTML = createSelectContent;

            allSelectDiv.appendChild(createSelect);

            loadSelect();
          }
        });
      });
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/transactions-view.inc.php?view=2&id=" + id.value,
    true
  );
  xmlhttp.send();

  // setTimeout(() => {
  //   alert.classList.add("hide");
  // }, 5000);
});
