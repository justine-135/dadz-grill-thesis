window.addEventListener("load", () => {
  const editBtn = document.querySelectorAll(".edit-show");
  const formDivHidden = document.querySelectorAll(".profile-form");

  editBtn.forEach((element) => {
    let thisEditBtn = element;

    thisEditBtn.addEventListener("click", () => {
      let thisFormDiv = element.parentElement.parentElement.childNodes[3];

      formDivHidden.forEach((element) => {
        let formDiv = element;
        formDiv.classList.add("hide");
      });

      editBtn.forEach((element) => {
        let editBtn = element;

        editBtn.classList.remove("hide");
      });

      thisEditBtn.classList.toggle("hide");

      thisFormDiv.classList.toggle("hide");
    });
  });
});
