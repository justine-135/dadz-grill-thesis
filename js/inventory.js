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
      if (
        element.parentElement.parentElement.childNodes[5].innerHTML != "Sets"
      ) {
        document.querySelector(".edit-servings-div").classList.remove("hide");
        document.querySelector(".edit-grams-div").classList.remove("hide");
        document.querySelector(".edit-inclusions").classList.add("hide");
      } else {
        document.querySelector(".edit-servings-div").classList.add("hide");
        document.querySelector(".edit-grams-div").classList.add("hide");
        document.querySelector(".edit-inclusions").classList.remove("hide");
      }
      overlay.classList.add("open");
      updateItemForm.classList.add("open");
      insertItemForm.classList.add("remove");
      deleteItemForm.classList.add("remove");
      const name = document.querySelector(".upd-ing-name");
      const group = document.querySelector(".upd-ing-group");
      const cost = document.querySelector(".upd-ing-cost");
      const status = document.querySelector(".upd-ing-stat");
      const id = document.querySelector(".upd-ing-id");
      const grams = document.querySelector(".upd-ing-grams");
      const grams2 = document.querySelector(".upd-ing-grams2");
      const servings = document.querySelector(".upd-ing-servings");
      const img = document.querySelector(".upd-ing-img");
      let name2 = "";
      console.log();

      grams2.value =
        element.parentElement.parentElement.childNodes[9].childNodes[1].innerHTML.replace(
          ",",
          ""
        );
      console.log(grams2.value);
      name.value = element.parentElement.parentElement.childNodes[1].innerHTML;
      group.value = element.parentElement.parentElement.childNodes[5].innerHTML;

      cost.value =
        element.parentElement.parentElement.childNodes[7].childNodes[1].innerHTML;
      grams.value = 0;
      servings.value =
        element.parentElement.parentElement.childNodes[11].childNodes[1].innerHTML;
      status.value =
        element.parentElement.parentElement.childNodes[13].firstChild.innerHTML;
      id.value = element.parentElement.parentElement.id;

      name2 = element.parentElement.parentElement.childNodes[17];
      console.log(name2);
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          document.querySelector(".inclusions-table").innerHTML =
            this.responseText;
        }
      };
      xmlhttp.open(
        "GET",
        "./includes/foods-view-edit-inc.inc.php?name=" + name2.innerHTML,
        true
      );
      xmlhttp.send();
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

  const grams = document.querySelectorAll(".grams");
  grams.forEach((element) => {
    let gram = parseFloat(element.innerHTML)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    element.innerHTML = gram;
  });

  const foodPrices = document.querySelectorAll(".prices");
  foodPrices.forEach((element) => {
    let foodPrice = parseFloat(element.innerHTML)
      .toFixed(2)
      .toString()
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    element.innerHTML = foodPrice;
  });

  // const infoServer = () => {
  //   let xmlhttp = new XMLHttpRequest();
  //   xmlhttp.onreadystatechange = function () {
  //     if (this.readyState == 4) {
  //       document.querySelector(".foods-table").innerHTML = this.responseText;
  //     }
  //   };
  //   xmlhttp.open("GET", "./includes/foods-view.inc.php", true);
  //   xmlhttp.send();
  // };

  // infoServer();

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);

  const inclusionsDiv = document.querySelector(".add-inclusion");
  const inclusionsBtnDiv = document.querySelector(".add-remove-inclusions-div");
  const addGroup = document.querySelector(".add-select-group");
  const addServings = document.querySelector(".servings-input");
  const gramsServings = document.querySelector(".grams-input");

  addGroup.addEventListener("change", (e) => {
    console.log(e.target.value);
    if (e.target.value != "Sets") {
      addServings.classList.remove("hide");
      gramsServings.classList.remove("hide");
      inclusionsDiv.classList.add("hide");
      inclusionsBtnDiv.classList.add("hide");
    } else {
      addServings.classList.add("hide");
      gramsServings.classList.add("hide");
      inclusionsDiv.classList.remove("hide");
      inclusionsBtnDiv.classList.remove("hide");
    }
  });

  const loadInclusionSelects = () => {
    const inclusionSelects = document.querySelectorAll(".inclusion-select");

    inclusionSelects.forEach((element) => {
      let inclusion = element;

      inclusion.addEventListener("change", (e) => {
        let itemName = inclusion.options[inclusion.selectedIndex].id;
        let value2value = inclusion.options[inclusion.selectedIndex];
        inclusion.nextElementSibling.value = itemName;

        console.log(value2value);
        console.log(inclusion.value);
      });
    });
  };

  loadInclusionSelects();

  const addInclusion = document.querySelector(".add-inclusion-btn");
  const origInclusion = document.querySelector(".orig-select");
  const clone = origInclusion.cloneNode(true);

  let count = 1;

  addInclusion.addEventListener("click", (e) => {
    count++;
    const createSelect = document.createElement("div");
    createSelect.setAttribute("class", "flex-row add-code");
    const createSelectContent = `
    <span>Inclusions ${count}: </span>
    <div>
        <div class="flex-row"  style="width: 70%; margin-left: auto">
        <select class="form-select inclusion-select" name="inclusions[]">
        ${clone.innerHTML}
        </select>
        <input hidden type="text" name="inclusion_name[]">
        <input style="width: 100%" name="serving[]" type="number" placeholder="g" />
        </div>
    </div>
    `;
    createSelect.innerHTML = createSelectContent;

    inclusionsDiv.appendChild(createSelect);
    loadInclusionSelects();
  });

  const delInclusions = document.querySelector(".delete-inclusion-btn");

  delInclusions.addEventListener("click", (e) => {
    count--;
    console.log();
    e.target.parentElement.previousSibling.previousSibling.lastChild.remove();
    loadInclusionSelects();
  });
});
