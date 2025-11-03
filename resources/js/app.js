import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Hamburger
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});

document.addEventListener("click", function (event) {
    const targetElement = event.target;

    if (
        !navMenu.contains(targetElement) &&
        !hamburger.contains(targetElement)
    ) {
        navMenu.classList.add("hidden");
        hamburger.classList.remove("hamburger-active");
    }
});
