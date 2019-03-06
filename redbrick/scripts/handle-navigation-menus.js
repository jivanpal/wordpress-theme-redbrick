/**
 * This script handles the visibility of the main menu and submenus in the
 * naivgation menu (hamburger menu). It does so by toggling the `hidden` class
 * on `nav .menu` and the `visible` class on instances of `nav .submenu` as
 * appropriate.
 */

var navigationMainMenu = document.querySelector("header nav .menu");
var itemsWithSubmenus = document.querySelectorAll("header nav .menu li.has-submenu");

/**
 * Get the slug of the given menu item.
 * This is an unsafe function that relies on the slug being stored as the only
 * class of the sole `span` element within the given menu item.
 */
function redbrick_get_menu_item_slug(menuItem) {
    return menuItem.querySelector("span").className;
}

/**
 * Hide the main navigation menu, if visible.
 */
function redbrick_hide_navigation_main_menu() {
    navigationMainMenu.classList.add("hidden");
}

/** 
 * Reveal the main navigation menu, if hidden.
 */
function redbrick_show_navigation_main_menu() {
    navigationMainMenu.classList.remove("hidden");
}

/**
 * Reveal the submenu for a given slug, if hidden.
 * @param {*} slug The slug of the submenu to reveal, as a string.
 */
function redbrick_show_navigation_submenu(slug) {
    var submenu = document.querySelector("header nav .submenu."+slug);
    submenu.classList.add("visible");
}

/**
 * Hide the submenu for a given slug, if visible.
 * @param {*} slug The slug of the submenu to reveal, as a string.
 */
function redbrick_hide_navigation_submenu(slug) {
    var submenu = document.querySelector("header nav .submenu."+slug);
    submenu.classList.remove("visible");
}

for (var i = 0; i < itemsWithSubmenus.length; i++) {
    var mainMenuItem = itemsWithSubmenus[i];
    var slug = redbrick_get_menu_item_slug(mainMenuItem);

    // Add event handlers for the main menu item
    mainMenuItem.addEventListener(
        "click",
        function() {
            redbrick_show_navigation_submenu(slug);
            redbrick_hide_navigation_main_menu();
        }
    );

    // Add event handlers the the submenu's back button
    var backButton = document.querySelector("header nav .submenu."+slug+" .back-button");

    backButton.addEventListener(
        "click",
        function() {
            redbrick_show_navigation_main_menu();
            setTimeout(
                function() {
                    redbrick_hide_navigation_submenu(slug);
                },
                300
            );
        }
    );
}


