/**
 * This script sets the classes `left-shadow` and `right-shadow` on
 * `.showcase-container` appropriately depending on scroll position to show
 * shadows that hint at the presence of more content for the user to scroll
 * through.
 */

var showcaseContainer = document.querySelector(".showcase-container");
var showcase = document.querySelector(".showcase");
var tolerance = 10; // min-distance from edge in order to activate shadow

function redbrick_set_showcase_shadows() {
    if (showcase.scrollLeft < tolerance) {
        showcaseContainer.classList.remove("left-shadow");
        showcaseContainer.classList.add("right-shadow");
    } else if (showcase.scrollWidth - showcase.clientWidth - showcase.scrollLeft < tolerance) {
        showcaseContainer.classList.add("left-shadow");
        showcaseContainer.classList.remove("right-shadow");
    } else {
        showcaseContainer.classList.add("left-shadow");
        showcaseContainer.classList.add("right-shadow");
    }
}

showcase.onscroll = redbrick_set_showcase_shadows;
