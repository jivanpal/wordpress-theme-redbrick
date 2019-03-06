/**
 * This script toggles the class `visible` on `<nav>` when given elements are
 * clicked. The hamburger menu itself can only be seen on screen when it has the
 * class `visible`.
 */

var hamburgerMenu = document.querySelector("header nav");

function redbrick_toggle_hamburger_menu() {
    hamburgerMenu.classList.toggle("visible");
}

function redbrick_hide_hamburger_menu() {
    hamburgerMenu.classList.remove("visible");
}

// Elements which toggle hamburger menu visibility

document.querySelector("header .hamburger").addEventListener(
    "click",
    redbrick_toggle_hamburger_menu
);

// Elements which hide the hamburger menu

document.querySelector("header nav .rest-of-screen").addEventListener(
    "click",
    redbrick_hide_hamburger_menu
);

document.querySelector("header .search").addEventListener(
    "click",
    redbrick_hide_hamburger_menu
);
