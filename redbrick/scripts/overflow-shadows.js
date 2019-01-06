/**
 * This script sets the classes `left-shadow` and `right-shadow` on containers
 * for regions that overflow and which we would like to apply shadows that hint
 * at the presence of more content for the user to scroll through.
 */

var tolerance = 10; // min-distance from edge in order to activate shadow

/**
 * An array of pairs (arrays of length 2), where each pair consists of:
 * • a shadow container
 * • the scrollable element belonging to that shadow container
 */
var overflowXPairs = [
    [
        document.querySelector(".showcase-container"),
        document.querySelector(".showcase"),
    ],
    [
        document.querySelector("header nav"),
        document.querySelector("header nav > ul"),
    ],
];

function redbrick_set_overflow_x_shadows(shadowContainer, scrollableElement) {
    if (scrollableElement.scrollLeft < tolerance) {
        shadowContainer.classList.remove("left-shadow");
        shadowContainer.classList.add("right-shadow");
    } else if (scrollableElement.scrollWidth - scrollableElement.clientWidth - scrollableElement.scrollLeft < tolerance) {
        shadowContainer.classList.add("left-shadow");
        shadowContainer.classList.remove("right-shadow");
    } else {
        shadowContainer.classList.add("left-shadow");
        shadowContainer.classList.add("right-shadow");
    }
}

for (let i = 0; i < overflowXPairs.length; i++) {
    // Set shadows on page load
    redbrick_set_overflow_x_shadows(overflowXPairs[i][0], overflowXPairs[i][1]);

    // Set shadows on scroll
    overflowXPairs[i][1].onscroll = function() {
        redbrick_set_overflow_x_shadows(overflowXPairs[i][0], overflowXPairs[i][1]);
    }
}
