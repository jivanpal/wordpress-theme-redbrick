<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div class="hamburger">
                <?php echo file_get_contents(get_template_directory() . '/assets/hamburger.svg'); ?>
            </div>
            <div class="central-element">
                <a href="/">
                    <div class="logo">
                        <div class="icon">
                            <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-icon.svg'); ?>
                        </div>
                        <div class="wordmark">
                            <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-wordmark.svg'); ?>
                        </div>
                    </div>
                </a>
                <nav>
                    <div class="menu-container">
                        <ul class="menu">
                            <?php
                                /**
                                 * TODO: Fetch navigation items from an
                                 * admin-configurable WordPress menu here.
                                 */
                            ?>
                            <li class="has-submenu tint red"><a href="/news">
                                <span class="news">News</span>
                            </a></li>
                            <li class="has-submenu tint orange"><a href="/comment">
                                <span class="comment">Comment</span>
                            </a></li>
                            <li class="tint yellow"><a href="/culture">
                                <span class="culture">Culture</span>
                            </a></li>
                            <li class="tint green"><a href="/music">
                                <span class="music">Music</span>
                            </a></li>
                            <li class="tint blue"><a href="/film">
                                <span class="film">Film</span>
                            </a></li>
                            <li class="tint red"><a href="/tv">
                                <span class="tv">TV</span>
                            </a></li>
                            <li class="tint orange"><a href="/gaming">
                                <span class="gaming">Gaming</span>
                            </a></li>
                            <li class="tint yellow"><a href="/food-and-drink">
                                <span class="food-drink">Food&amp;Drink</span>
                            </a></li>
                            <li class="tint green"><a href="/travel">
                                <span class="travel">Travel</span>
                            </a></li>
                            <li class="tint blue"><a href="/life-and-style">
                                <span class="life-style">Life&amp;Style</span>
                            </a></li>
                            <li class="tint red"><a href="/sci-and-tech">
                                <span class="sci-tech">Sci&amp;Tech</span>
                            </a></li>
                            <li class="tint orange"><a href="/sport">
                                <span class="sport">Sport</span>
                            </a></li>
                            <li class="tint yellow"><a href="/features">
                                <span>Features</span>
                            </a></li>
                            <li class="tint green"><a href="/radio">
                                <span>Radio</span>
                            </a></li>
                        </ul>
                        <div class="submenu-container">
                            <ul class="submenu news">
                                <li class="back-button"><a href="#">
                                    <span>&lt; Back</span>
                                </a></li>
                                <li><a href="#">
                                    <span>All News</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Guild of Students</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Campus</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Selly Oak</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Birmingham</span>
                                </a></li>
                                <li><a href="#">
                                    <span>National</span>
                                </a></li>
                            </ul>
                            <ul class="submenu comment">
                                <li class="back-button"><a href="#">
                                    <span>&lt; Back</span>
                                </a></li>
                                <li><a href="#">
                                    <span>All Comment</span>
                                </a></li>
                                <li><a href="#">
                                    <span>International</span>
                                </a></li>
                                <li><a href="#">
                                    <span>National</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Features</span>
                                </a></li>
                                <li><a href="#">
                                    <span>Politics</span>
                                </a></li>
                            </ul>
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
                    <div class="rest-of-screen"></div>
                </div>
            </div>
        </header>
