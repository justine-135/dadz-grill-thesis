window.addEventListener("load", () => {
  const dashboardLi = document.querySelector(".admin-li");
  dashboardLi.classList.add("active");
  dashboardLi.querySelector(".inactive-link").className = "active-link";

  const overlay = document.querySelector(".overlay");
  const deleteAccForm = document.querySelector(".delete-account-form");
  const deleteAccFormBody = document.querySelector(
    ".delete-account-form .body"
  );

  const infoServer = (user) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".account-information").innerHTML =
          this.responseText;
      }

      const rolesToggle = document.querySelectorAll(".roles-btn");

      rolesToggle.forEach((element) => {
        element.addEventListener("click", () => {
          element.nextElementSibling.classList.toggle("open");
        });

        element.childNodes[1].innerHTML = element.previousElementSibling.value;
      });

      const roleInputs = document.querySelectorAll(".role-input");

      roleInputs.forEach((element) => {
        element.addEventListener("change", () => {
          console.log(element.previousElementSibling.value);
          element.previousElementSibling.value = element.value;
          // element.parentElement.parentElement.previousElementSibling.previousElementSibling.value =
          //   element.value;
          // element.parentElement.parentElement.previousElementSibling.childNodes[1].innerHTML =
          //   element.value;
          // element.parentElement.parentElement.classList.toggle("open");
        });
      });
    };
    xmlhttp.open("GET", "./includes/userinfo-view.inc.php?id=" + user, true);
    xmlhttp.send();
  };

  setInterval(() => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        document.querySelector(".admin-table-info").innerHTML =
          this.responseText;
      }
      const deleteBtn = document.querySelectorAll(".delete-account-btn");
      const viewBtn = document.querySelectorAll(".view-account-btn");
      const viewInfoForm = document.querySelector(".view-account-container");
      const closeModalBtn = document.querySelectorAll(".close-add-form");
      const closeModalBtn2 = document.querySelectorAll(".form-footer-btn");

      deleteBtn[0].disabled = true;
      viewBtn[0].disabled = true;

      const editBtns = document.querySelectorAll(".user-edit-btn");
      const editRoleDivBtn = document.querySelector(".role-select-div");
      const editPwdBtn = document.querySelector(".pwd-div");

      editBtns.forEach((editBtn) => {
        editBtn.addEventListener("click", () => {
          let btnId = editBtn.getAttribute("id");
          editBtn.parentElement.nextElementSibling.classList.remove("hide");
          if (btnId == "edit-role") {
            editPwdBtn.classList.add("hide");
          } else {
            editRoleDivBtn.classList.add("hide");
          }

          console.log(editBtn.parentElement.parentElement);
        });
      });

      deleteBtn.forEach((element) => {
        element.addEventListener("click", () => {
          overlay.classList.add("open");
          deleteAccForm.classList.add("open");
          viewInfoForm.classList.add("remove");
          console.log(element.parentElement.parentElement.childNodes);

          let item = `
            <div class="delete-message">Are you sure you want to delete this item?</div>
            <div class="items flex-row">
                <span>Username: </span><span>
                ${element.parentElement.parentElement.childNodes[7].innerHTML}  
                </span>
            </div>
            <div class="items flex-row">
                <span>Full name: </span><span>
                  ${element.parentElement.parentElement.childNodes[5].innerHTML}
                </span>
            </div>
            <div class="items flex-row">
                <span>Email: </span><span>
                 ${element.parentElement.parentElement.childNodes[9].innerHTML} 
                </span>
            </div>
            <input class="id" name="id-value" type="text" value="${element.parentElement.parentElement.childNodes[1].innerHTML}"
            } hidden>

      
            `;

          deleteAccFormBody.innerHTML = item;
        });
      });

      closeModalBtn.forEach((element) => {
        element.addEventListener("click", () => {
          overlay.classList.remove("open");
          viewInfoForm.classList.remove("open");
          viewInfoForm.classList.remove("remove");
          deleteAccForm.classList.remove("remove");
          deleteAccForm.classList.remove("open");
        });
      });

      closeModalBtn2.forEach((element) => {
        element.addEventListener("click", () => {
          overlay.classList.remove("open");
          viewInfoForm.classList.remove("open");
          viewInfoForm.classList.remove("remove");
          deleteAccForm.classList.remove("remove");
          deleteAccForm.classList.remove("open");
        });
      });

      viewBtn.forEach((element) => {
        element.addEventListener("click", () => {
          let userId =
            element.parentElement.parentElement.childNodes[1].innerHTML;
          overlay.classList.add("open");
          viewInfoForm.classList.add("open");
          deleteAccForm.classList.add("remove");

          infoServer(userId);
        });
      });
    };
    xmlhttp.open("GET", "./includes/users-view.inc.php?view=1", true);
    xmlhttp.send();
  }, 1000);

  setTimeout(() => {
    document.querySelector(".alert-div").classList.add("hide");
  }, 3000);
});
