/**
 * This script toggles the class `visible` on `.search-bar` when given elements
 * are clicked. The search bar itself can only be seen on screen when it has the
 * class `visible`.
 */

var searchBar = document.querySelector("header .search-bar");

function redbrick_toggle_search_bar() {
    searchBar.classList.toggle("visible");
}

function redbrick_hide_search_bar() {
    searchBar.classList.remove("visible");
}

// Elements which toggle search bar visibility

document.querySelector("header .search").addEventListener(
    "click",
    redbrick_toggle_search_bar
);

// Elements which hide the search bar

// document.querySelector("header .search-bar .rest-of-screen").addEventListener(
//     "click",
//     redbrick_hide_search_bar
// );

document.querySelector("header .hamburger").addEventListener(
    "click",
    redbrick_hide_search_bar
);
