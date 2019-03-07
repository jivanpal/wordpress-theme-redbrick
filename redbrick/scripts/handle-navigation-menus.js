/**
 * This script handles the visibility of the main menu and submenus in the
 * naivgation menu (hamburger menu). It does so by toggling the `hidden` class
 * on `nav .menu` and the `visible` class on instances of `nav .submenu` as
 * appropriate.
 * 
 * This script depends on `toggle-hamburger-menu.js` for the functions:
 * • `redbrick_show_hamburger_menu()`
 * • `redbrick_hide_hamburger_menu()`
 */

var navigationMainMenu = document.querySelector("header nav .menu");
var itemWithSubmenu = document.querySelectorAll("header nav .menu li.has-submenu");

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

for (var i = 0; i < itemWithSubmenu.length; i++) {
    let mainMenuItem = itemWithSubmenu[i];
    let slug = redbrick_get_menu_item_slug(mainMenuItem);
    let backButton = document.querySelector("header nav .submenu."+slug+" .back-button");

    // Add click handler for the main menu items
    mainMenuItem.addEventListener(
        "click",
        function() {
            /** The currently visible submenu, if any; else `null` */
            let visibleSubmenu = document.querySelector("header nav .submenu.visible");

            /**
             * The following if-condition is always satisfied in mobile layout,
             * since there is no way to click a main menu button whilst a
             * submenu is visible; the user first needs to clikc a back button,
             * thereby hiding any visible submenu.
             */
            if (visibleSubmenu === null) {
                /**
                 * We ensure that the hamburger menu is visible, since if we are
                 * in desktop mode and switch to mobile mode, the submenu we
                 * revealed will then remain visible on screen.
                 */
                redbrick_show_hamburger_menu();
                redbrick_show_navigation_submenu(slug);
                redbrick_hide_navigation_main_menu();
            } else {
                // There is a submenu already visible; hide it.
                visibleSubmenu.classList.remove("visible");

                /** 
                 * Did we just click on the button for the submenu we just hid?
                 * If so, we need to reveal the main menu; else,
                 * we need to reveal the submenu for the button we clicked.
                 */
                if (visibleSubmenu.classList.contains(slug)) {
                    // We are in dekstop mode, so we can safely hide the hamburger menu.
                    redbrick_hide_hamburger_menu();
                    redbrick_show_navigation_main_menu();
                } else {
                    redbrick_show_navigation_submenu(slug);
                }
            }
        }
    );

    // Add click handler for each submenu's back button
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
