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

/**
 * An array of functions, one for each pair in the previous array. When the
 * respective function for a pair is called, it will set the overflow shadows
 * correctly for that pair.
 * 
 * This array is populated in the for-loop below.
 */
var overflowXFunctions = [];

function redbrick_set_overflow_x_shadows(shadowContainer, scrollableElement) {
    if (shadowContainer === null || scrollableElement === null) {
        return;
    }

    if (shadowContainer.scrollWidth == scrollableElement.scrollWidth) {
        shadowContainer.classList.remove("left-shadow");
        shadowContainer.classList.remove("right-shadow");
    } else {
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
}

for (let i = 0; i < overflowXPairs.length; i++) {
    overflowXFunctions.push(function () {
        redbrick_set_overflow_x_shadows(overflowXPairs[i][0], overflowXPairs[i][1]);
    })

    overflowXFunctions[i]();

    if (overflowXPairs[i][1] !== null) {
        overflowXPairs[i][1].addEventListener(
            "scroll",
            overflowXFunctions[i]
        );
    }
}

window.addEventListener('resize', function() {
    for (let i = 0; i < overflowXFunctions.length; i++) {
        overflowXFunctions[i]();
    }
})
