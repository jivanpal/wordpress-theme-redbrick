<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div class="content"><?php /** This wrapper allows the section highlight to be added by applying a bottom border to `.content`. */ ?>
                <div class="hamburger">
                    <?php echo file_get_contents(get_template_directory() . '/assets/hamburger.svg'); ?>
                </div>
                <div class="central-element">
                    <div class="logo">
                        <a href="/">
                            <div class="icon">
                                <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-icon.svg'); ?>
                            </div>
                            <div class="wordmark">
                                <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-wordmark.svg'); ?>
                            </div>
                        </a>
                    </div>
                    <?php $redbrick_nav_menu_tree = redbrick_get_nav_menu_items_tree(redbrick_get_nav_menu_object_at_location('redbrick_nav_menu_header')); ?>
                    <nav>
                        <div class="menu-container">
                            <ul class="menu">
                                <?php
                                foreach ($redbrick_nav_menu_tree as $redbrick_item_id => $redbrick_item) {
                                    echo redbrick_get_html_header_menu_item($redbrick_item_id, $redbrick_item);
                                }
                                ?>
                            </ul>
                            <div class="submenu-container">
                                <?php
                                foreach ($redbrick_nav_menu_tree as $redbrick_item_id => $redbrick_item) {
                                    echo redbrick_get_html_header_submenu_from_item($redbrick_item_id, $redbrick_item);
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        /**
                         * The following element covers the rest of the screen
                         * when the hamburger menu is visible, so that if the
                         * user clicks anywhere outside the hamburger menu or
                         * site header, the hamubrger menu disappears. This
                         * element is also responsible for rendering the
                         * hamburger menu's drop shadow. See `style.scss` for
                         * implementation details.
                         */
                        ?>
                        <div class="rest-of-screen"></div>
                    </nav>
                </div>
                <div class="search">
                    <?php echo file_get_contents(get_template_directory() . '/assets/search.svg'); ?>
                    <div class="search-bar">
                        <form id="search-form" action="/">
                            <input id="search-field" type="search" name="s" placeholder="Search"/>
                        </form>
                        <?php
                        /**
                         * The following element covers the rest of the screen
                         * when the search menu is visible, so that if the
                         * user clicks anywhere outside the search menu or
                         * site header, the search menu disappears. This
                         * element is also responsible for rendering the
                         * search menu's drop shadow. See `style.scss` for
                         * implementation details.
                         */
                        ?>
                        <div class="rest-of-screen"></div>
                    </div>
                </div>
            </div>
        </header>
