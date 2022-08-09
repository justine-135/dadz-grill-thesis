window.addEventListener("load", () => {
  const insertForm = document.querySelector("#insert-ing");
  const table = document.querySelector(".inventory-table tbody");

  insertForm.addEventListener("submit", (e) => {
    let codeVal = document.querySelector("#insert-code-val");
    let nameVal = document.querySelector("#insert-name-val");
    for (let i = 0; i < table.childNodes.length; i++) {
      const element = table.childNodes[i];
      let ev = i % 2;
      if (ev == 1) {
        if (
          element.childNodes[5].textContent == nameVal.value ||
          element.childNodes[1].textContent == codeVal.value
        ) {
          console.log("Item already added");
          e.preventDefault();
        }
      }
    }
  });
});
