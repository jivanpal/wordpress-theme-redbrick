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
                    <ul>
                        <?php
                            /**
                             * TODO: Fetch navigation items from an
                             * admin-configurable WordPress menu here.
                             */
                        ?>
                        <li class="tint red"><a href="/news">
                            <span>News</span>
                        </a></li>
                        <li class="tint orange"><a href="/comment">
                            <span>Comment</span>
                        </a></li>
                        <li class="tint yellow"><a href="/culture">
                            <span>Culture</span>
                        </a></li>
                        <li class="tint green"><a href="/music">
                            <span>Music</span>
                        </a></li>
                        <li class="tint blue"><a href="/film">
                            <span>Film</span>
                        </a></li>
                        <li class="tint red"><a href="/tv">
                            <span>TV</span>
                        </a></li>
                        <li class="tint orange"><a href="/gaming">
                            <span>Gaming</span>
                        </a></li>
                        <li class="tint yellow"><a href="/food-and-drink">
                            <span>Food&amp;Drink</span>
                        </a></li>
                        <li class="tint green"><a href="/travel">
                            <span>Travel</span>
                        </a></li>
                        <li class="tint blue"><a href="/life-and-style">
                            <span>Life&amp;Style</span>
                        </a></li>
                        <li class="tint red"><a href="/sci-and-tech">
                            <span>Sci&amp;Tech</span>
                        </a></li>
                        <li class="tint orange"><a href="/sport">
                            <span>Sport</span>
                        </a></li>
                        <li class="tint yellow"><a href="/features">
                            <span>Features</span>
                        </a></li>
                        <li class="tint green"><a href="/radio">
                            <span>Radio</span>
                        </a></li>
                    </ul>
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
