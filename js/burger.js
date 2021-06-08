let isBurgerPopped = false;
const clickBurger = () => {
  if (isBurgerPopped) {
    $("#topMenu").animate(
      {
        top: "-210px",
      },
      300
    );
    isBurgerPopped = false;
  } else {
    $("#topMenu").animate(
      {
        top: "26px",
      },
      300
    );
    isBurgerPopped = true;
  }
};
let burger = document.querySelector("#burgerMenu");
burger.addEventListener("click", clickBurger);
