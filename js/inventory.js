window.addEventListener("load", () => {
  // dynamic link
  const dashboardLi = document.querySelector(".inventory-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const insertItemForm = document.querySelector(".insert-item-form");
  const updateItemForm = document.querySelector(".update-item-form");
  const deleteItemForm = document.querySelector(".delete-item-form");

  // open form
  const addItemBtn = document.querySelector(".add-item-btn");
  addItemBtn.addEventListener("click", () => {
    overlay.classList.add("open");
    deleteItemForm.classList.add("remove");
    updateItemForm.classList.add("remove");
    insertItemForm.classList.add("open");
  });

  // close form
  const closeFormBtn = document.querySelectorAll(".close-add-form");
  closeFormBtn.forEach((element) => {
    element.addEventListener("click", () => {
      overlay.classList.remove("open");
      updateItemForm.classList.remove("open");
      insertItemForm.classList.remove("open");
      deleteItemForm.classList.remove("open");
      updateItemForm.classList.remove("remove");
      insertItemForm.classList.remove("remove");
      deleteItemForm.classList.remove("remove");
    });
  });
  const closeFormBtn2 = document.querySelectorAll(".form-footer-btn");
  closeFormBtn2.forEach((element) => {
    element.addEventListener("click", () => {
      overlay.classList.remove("open");
      updateItemForm.classList.remove("open");
      insertItemForm.classList.remove("open");
      deleteItemForm.classList.remove("open");
      updateItemForm.classList.remove("remove");
      insertItemForm.classList.remove("remove");
      deleteItemForm.classList.remove("remove");
    });
  });

  // open update ingridient form modal
  // input has existing values to be changed or updated
  const updateFormBtn = document.querySelectorAll(".update-item-btn");
  updateFormBtn.forEach((element) => {
    element.addEventListener("click", () => {
      console.log(element.parentElement.parentElement.childNodes);
      overlay.classList.add("open");
      updateItemForm.classList.add("open");
      insertItemForm.classList.add("remove");
      deleteItemForm.classList.add("remove");
      const name = document.querySelector(".upd-ing-name");
      const group = document.querySelector(".upd-ing-group");
      const cost = document.querySelector(".upd-ing-cost");
      const status = document.querySelector(".upd-ing-stat");
      const id = document.querySelector(".upd-ing-id");
      const img = document.querySelector(".upd-ing-img");

      console.log();

      name.value = element.parentElement.parentElement.childNodes[1].innerHTML;
      group.value = element.parentElement.parentElement.childNodes[5].innerHTML;

      status.value =
        element.parentElement.parentElement.childNodes[9].firstChild.innerHTML;
      cost.value = element.parentElement.parentElement.childNodes[7].innerHTML;
      id.value = element.parentElement.parentElement.id;
    });
  });

  // open alert modal
  const deleteItemBtn = document.querySelectorAll(".delete-item-btn");
  const alertBody = deleteItemForm.querySelector(".body");

  // alert modal has info of row to be deleted
  deleteItemBtn.forEach((element) => {
    element.addEventListener("click", () => {
      overlay.classList.add("open");
      deleteItemForm.classList.add("open");
      insertItemForm.classList.add("remove");
      updateItemForm.classList.add("remove");
      console.log(element.parentElement.parentElement.childNodes[1].innerHTML);

      let item = `
            <div class="delete-message">Are you sure you want to delete this item?</div>
            <div class="items flex-row">
                <span>Food Id: </span><span>${
                  element.parentElement.parentElement.childNodes[1].innerHTML
                }</span>
            </div>
            <div class="items flex-row">
                <span>Item Name: </span><span>${
                  element.parentElement.parentElement.childNodes[5].innerHTML
                }</span>
            </div>
            <div class="items flex-row">
                <span>Item Group: </span><span>${
                  element.parentElement.parentElement.childNodes[7].innerHTML
                }</span>
            </div>
            <input class="id" name="id-value" type="text" value=${
              element.parentElement.parentElement.id
            } hidden>
            <input class="id" name="img-value" type="text" value=${element.parentElement.parentElement.childNodes[3].childNodes[1].getAttribute(
              "src"
            )} hidden>

            `;

      alertBody.innerHTML = item;
    });
  });
});
