/**
 * This script toggles the class `visible` on `.search-bar` when given elements
 * are clicked. The search bar itself can only be seen on screen when it has the
 * class `visible`.
 */

var searchBar = document.querySelector("header .search-bar");
var searchField = document.querySelector("#search-field");

function redbrick_toggle_search_bar() {
    searchBar.classList.toggle("visible");
    if (searchBar.classList.contains("visible")) {
        searchField.focus();
    }
}

function redbrick_hide_search_bar() {
    searchBar.classList.remove("visible");
    if (searchBar.classList.contains("visible")) {
        searchField.focus();
    }
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

// Prevent clicking anywhere on the search bar from causing it to hide itself

document.querySelector("#search-form").addEventListener(
    "click",
    function(event) {
        event.stopPropagation();
    }
);
