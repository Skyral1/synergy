document.addEventListener("DOMContentLoaded", () => {
    const burgerMenu = document.querySelector(".burger-menu");
    const burgerList = document.querySelector(".burger-list");

    burgerMenu.addEventListener("click", () => {
        burgerList.classList.toggle("active"); // Toggle la classe 'active' sur la liste du burger
        burgerMenu.classList.toggle("change");
    });
});
