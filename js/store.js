window.addEventListener("load", () => {
  const categoryBtns = document.querySelectorAll(".nav-buttons button");
  const popularContainer = document.querySelector(".popular-container");
  const setsContainer = document.querySelector(".sets-container");
  const sidesContainer = document.querySelector(".sides-container");
  const drinksContainer = document.querySelector(".drinks-container");
  const addonsContainer = document.querySelector(".addons-container");

  // initially show popular foods
  popularContainer.classList.add("show");

  for (let i = 0; i < categoryBtns.length; i++) {
    const element = categoryBtns[i];

    // adds "active" class to clicked button while removing unactive ones
    // add animations and toggles hide and show to menu containers
    element.addEventListener("click", (e) => {
      element.parentElement.childNodes[1].classList.remove("active");
      element.parentElement.childNodes[3].classList.remove("active");
      element.parentElement.childNodes[5].classList.remove("active");
      element.parentElement.childNodes[7].classList.remove("active");
      element.parentElement.childNodes[9].classList.remove("active");

      element.classList.add("active");

      hideGroupContainers();
      if (element.id == "all") {
        popularContainer.classList.add("show");
      }
      if (element.id == "sets") {
        setsContainer.classList.add("show");
      }
      if (element.id == "sides") {
        sidesContainer.classList.add("show");
      }
      if (element.id == "drinks") {
        drinksContainer.classList.add("show");
      }
      if (element.id == "addons") {
        addonsContainer.classList.add("show");
      }
    });
  }

  const hideGroupContainers = () => {
    popularContainer.classList.remove("show");
    setsContainer.classList.remove("show");
    sidesContainer.classList.remove("show");
    drinksContainer.classList.remove("show");
    addonsContainer.classList.remove("show");
  };
});
