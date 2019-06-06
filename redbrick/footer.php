        <footer>
            <div class="upper">
                <div class="constrained">
                    <div class="social-media">
                        <h1>Connect</h1>
                        <ul>
                            <li><a href="https://www.facebook.com/redbrickpaper/">
                                <div class="icon-container">
                                    <?php echo file_get_contents(get_template_directory() . '/assets/facebook-icon.svg'); ?>
                                </div>
                            </a></li>
                            <li><a href="https://twitter.com/redbrickpaper">
                                <div class="icon-container">
                                    <?php echo file_get_contents(get_template_directory() . '/assets/twitter-icon.svg'); ?>
                                </div>
                            </a></li>
                            <li><a href="https://www.instagram.com/redbrickpaper/">
                                <div class="icon-container">
                                    <?php echo file_get_contents(get_template_directory() . '/assets/instagram-icon.svg'); ?>
                                </div>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="lower">
                <div class="constrained flex-container">
                    <div class="latest-issue">
                        <?php /** TODO: Make this section admin-configurable */ ?>
                        <a href="#">
                            <div class="summary">
                                <h1>Issue #1500</h1>
                                <h2>7 December 2018</h2>
                                <ul>
                                    <li>Comment: The true meaning of Christmas</li>
                                    <li>Gaming: The best games of the year</li>
                                </ul>
                            </div>
                            <div class="thumbnail">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/mockups/front-page.jpg"/>
                            </div>
                        </a>
                    </div>
                    
                    <?php $redbrick_footer_menu_tree = redbrick_get_nav_menu_items_tree(redbrick_get_nav_menu_object_at_location('redbrick_nav_menu_footer')); ?>
                    <?php if ($redbrick_footer_menu_tree) : ?>
                        <div class="footer-links">
                            <?php echo redbrick_get_html_list_from_menu_tree($redbrick_footer_menu_tree); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
