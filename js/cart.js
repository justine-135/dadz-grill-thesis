window.addEventListener("load", () => {
  const selectedItem = document.querySelectorAll(".item-btn button");
  const cartList = document.querySelector(".cart-list");
  const formPurchase = document.querySelector(".submit-sale");

  // get data from selected food
  for (let i = 0; i < selectedItem.length; i++) {
    const element = selectedItem[i];

    element.addEventListener("click", (e) => {
      let url = element.childNodes[1].src;
      let name = element.childNodes[3].childNodes[1].innerHTML;

      let price;
      try {
        price =
          element.childNodes[3].childNodes[5].childNodes[1].childNodes[3]
            .innerHTML;
      } catch (error) {
        price =
          element.childNodes[3].childNodes[7].childNodes[1].childNodes[3]
            .innerHTML;
      }

      let id = element.childNodes[3].childNodes[3].value;
      let quantity = 0;

      let origPrice =
        element.childNodes[3].childNodes[5].childNodes[1].childNodes[3]
          .innerHTML;

      let serving =
        element.childNodes[3].childNodes[5].childNodes[1].childNodes[5].value;

      let incInfos = element.querySelectorAll(".inclusion-info");

      let arrInclusionId = [];
      let arrInclusionName = [];
      let arrInclusionServing = [];

      incInfos.forEach((element) => {
        if (element.name == "inclusion_name[]") {
          arrInclusionName.push(element.value);
        } else if (element.name == "inclusion_id[]") {
          arrInclusionId.push(element.value);
        } else {
          arrInclusionServing.push(element.value);
        }
      });

      let grams =
        element.childNodes[3].childNodes[7].querySelectorAll(".inventory-gram");

      let thisItemGram = element.childNodes[3].childNodes[7].querySelector(
        ".this-inventory-gram"
      );
      let thisItemServing = element.childNodes[3].childNodes[7].querySelector(
        ".this-inventory-serving"
      );
      let notadd = 0;

      if (parseFloat(thisItemServing.value) > parseFloat(thisItemGram.value)) {
        notadd = 1;
      }

      console.log("serving", thisItemServing.value, "gram", thisItemGram.value);

      let servingArrValue = [];
      let gramArrValue = [];
      grams.forEach((element) => {
        let gram = element.value;
        let incServing = element.previousElementSibling.value;

        servingArrValue.push(incServing);
        gramArrValue.push(gram);
        if (parseFloat(incServing) > parseFloat(gram)) {
          notadd = 1;
        }

        console.log(incServing, gram);
      });

      if (notadd != 1) {
        addCart(
          url,
          name,
          price,
          quantity,
          id,
          origPrice,
          serving,
          servingArrValue,
          gramArrValue
        );
      }

      notadd = 0;
    });
  }

  // add item to cart
  let exec = 0;

  const addCart = (
    url,
    name,
    price,
    quantity,
    id,
    origPrice,
    serving,
    servingArrValue,
    gramArrValue
  ) => {
    const createItem = document.createElement("div");

    // do not allow duplicate items
    let itemName = document.querySelectorAll(".cart-item-name");
    for (let i = 0; i < itemName.length; i++) {
      const element = itemName[i];
      if (element.innerHTML == name) {
        return;
      }
    }

    createItem.setAttribute("class", "flex-row cart-item");
    let inner = `
            <div class="item-img-name flex-column">
                <img src="${url}" alt="">
                <span class="cart-item-name">${name}</span>
                <input type="text" value="${name}" name="names[]" id="" hidden>
            </div>
            <div class="price">
                <span class="cart-item-price" id="${price}">${price}</span>
                <input type="text" value="${price}" name="prices[]" id="" hidden>
                <input type="text" value="${origPrice}" name="orig_price[]" id="" hidden>
                <input type="text" value="${id}" name="item_id[]" id="" hidden>
                <input type="text" value="${serving}" name="servings[]" id="" hidden>
            </div>
            <div class="control flex-row">
                <button class="decrement" type="button">-</button>
                <input class="cart-item-quantity" type="text" value="1" max="${quantity}" name="quantities[]" id="" readonly>
                <button class="increment" type="button">+</button>
            </div>
    `;

    createItem.innerHTML = inner;

    cartList.appendChild(createItem);

    calcTotal();
    adjustQuantity(servingArrValue, gramArrValue);
    exec++;
    formatPrices();
  };

  // increase, decrease quantity of each item
  const adjustQuantity = (servingArrValue, gramArrValue) => {
    const incBtns = document.querySelectorAll(".increment");

    // initialize increment button
    let incBtn;
    for (let i = 0; i < incBtns.length; i++) {
      //move increment button event outside loop
      incBtn = incBtns[i];
    }

    // multiply quantity to price
    let price;
    let itemServing = document.querySelectorAll(".serving");
    let itemServings;
    let tmpItemServings;
    let tmpTotalServing;

    incBtn.addEventListener("click", (e) => {
      const button = e.target;
      let value = parseFloat(button.parentElement.childNodes[3].value);

      let notAdd = 0;
      for (let i = 0; i < servingArrValue.length; i++) {
        let servingValue = parseFloat(servingArrValue[i]);
        let gramValue = gramArrValue[i];

        if (servingValue > gramValue) {
          notAdd = 1;
        }

        servingValue[i] += servingValue;
        console.log(servingValue, gramValue);
      }

      console.log(notAdd);
      if (notAdd != 1) {
        // value cannot surpass maximum quantity stored
        if (button.parentElement.childNodes[3].getAttribute("max") == value) {
          value = button.parentElement.childNodes[3].getAttribute("max");
          return;
        }
        value++;
        button.parentElement.childNodes[3].value = value;

        price = parseFloat(
          button.parentElement.parentElement.childNodes[3].childNodes[1].id
        );

        let incremented = price * value;
        button.parentElement.parentElement.childNodes[3].childNodes[1].innerHTML =
          incremented;
        button.parentElement.parentElement.childNodes[3].childNodes[3].value =
          incremented;

        // Initial serving
        itemServings =
          button.parentElement.parentElement.childNodes[3].childNodes[9].value;

        if (value <= 2) {
          tmpItemServings = itemServings;
        }

        let totalServing =
          parseFloat(itemServings) + parseFloat(tmpItemServings);
        button.parentElement.parentElement.childNodes[3].childNodes[9].value =
          totalServing;

        tmpTotalServing = totalServing;

        calcTotal();
        formatPrices();
      }
    });

    const decBtns = document.querySelectorAll(".decrement");
    // initialize increment button
    let decBtn;
    for (let i = 0; i < decBtns.length; i++) {
      //move increment button event outside loop
      decBtn = decBtns[i];
    }

    // multiply quantity to price
    decBtn.addEventListener("click", (e) => {
      const button = e.target;
      let value = parseFloat(button.parentElement.childNodes[3].value);
      value--;

      // if quantity reaches 0, remove item
      if (value == 0) {
        // cartList.removeChild(button.parentElement.parentElement);
        cartList.removeChild(button.parentElement.parentElement);
      }
      button.parentElement.childNodes[3].value = value;

      price = parseFloat(
        button.parentElement.parentElement.childNodes[3].childNodes[1].id
      );

      let decremented = price * value;
      button.parentElement.parentElement.childNodes[3].childNodes[1].innerHTML =
        decremented;

      let totalServing =
        parseFloat(tmpTotalServing) - parseFloat(tmpItemServings);
      button.parentElement.parentElement.childNodes[3].childNodes[9].value =
        totalServing;

      tmpTotalServing = totalServing;
      calcTotal();
      formatPrices();
    });
  };

  const calcTotal = () => {
    let itemPrice = document.querySelectorAll(".cart-item-price");
    let total = 0;

    for (let i = 0; i < itemPrice.length; i++) {
      const element = itemPrice[i].innerHTML;
      total += parseFloat(element);
    }

    let totalPrice = document.querySelector(".total-text .price input");
    totalPrice.value = total
      .toFixed(2)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  };

  formPurchase.addEventListener("submit", (e) => {
    if (cartList.childElementCount == 0) {
      e.preventDefault();
    }
  });

  const formatPrices = () => {
    let cartItemPrices = document.querySelectorAll(".cart-item-price");

    cartItemPrices.forEach((element) => {
      let cartItemPrice = parseFloat(element.innerHTML);
      element.innerHTML = cartItemPrice.toFixed(2).toString();
    });
  };
});
