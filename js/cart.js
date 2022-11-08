window.addEventListener("load", () => {
  const selectedItem = document.querySelectorAll(".item-btn button");
  const cartList = document.querySelector(".cart-list");
  const formPurchase = document.querySelector(".submit-sale");

  // get data from selected food
  for (let i = 0; i < selectedItem.length; i++) {
    const element = selectedItem[i];

    element.addEventListener("click", (e) => {
      let url = element.childNodes[1]
        .getAttribute("style")
        .match(/url\(["']?([^"']*)["']?\)/)[1];
      let name = element.childNodes[3].childNodes[1].innerHTML;
      let price =
        element.childNodes[3].childNodes[5].childNodes[1].childNodes[3]
          .innerHTML;

      let id = element.childNodes[3].childNodes[3].value;
      let quantity = 0;

      let origPrice =
        element.childNodes[3].childNodes[5].childNodes[1].childNodes[3]
          .innerHTML;

      addCart(url, name, price, quantity, id, origPrice);
    });
  }

  // add item to cart
  let exec = 0;

  const addCart = (url, name, price, quantity, id, origPrice) => {
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
    adjustQuantity();
    exec++;
  };

  // increase, decrease quantity of each item
  const adjustQuantity = () => {
    const incBtns = document.querySelectorAll(".increment");

    // initialize increment button
    let incBtn;
    for (let i = 0; i < incBtns.length; i++) {
      //move increment button event outside loop
      incBtn = incBtns[i];
    }

    // multiply quantity to price
    let price;
    incBtn.addEventListener("click", (e) => {
      const button = e.target;
      let value = parseFloat(button.parentElement.childNodes[3].value);

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

      calcTotal();
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

      calcTotal();
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
    totalPrice.value = total;
  };

  formPurchase.addEventListener("submit", (e) => {
    if (cartList.childElementCount == 0) {
      e.preventDefault();
    }
  });
});
