/**
 * This script adds the `div.opening-quotemark` element to pullquotes created
 * in the WordPress editor, i.e. `.wp-block-pullquote blockquote` elements).
 */

var redbrick_pullquoteElements = document.querySelectorAll(".wp-block-pullquote blockquote");

for (var i = 0; i < redbrick_pullquoteElements.length; i++) {
    redbrick_pullquoteElements[i].insertAdjacentHTML("afterbegin", '<div class="opening-quotemark">“</div>');
}
