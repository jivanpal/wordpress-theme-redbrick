        <footer>
            <div class="container">
                <div class="social-media">
                    <h1>Connect</h1>
                    <ul>
                        <?php /** TODO: Fetch social media menu here */ ?>
                        <li><a href="#">
                            <div class="icon-container">
                                <?php echo file_get_contents(get_template_directory() . '/assets/facebook-icon.svg'); ?>
                            </div>
                        </a></li>
                        <li><a href="#">
                            <div class="icon-container">
                                <?php echo file_get_contents(get_template_directory() . '/assets/twitter-icon.svg'); ?>
                            </div>
                        </a></li>
                        <li><a href="#">
                            <div class="icon-container">
                                <?php echo file_get_contents(get_template_directory() . '/assets/instagram-icon.svg'); ?>
                            </div>
                        </a></li>
                    </ul>
                </div>
                <a href="#">
                    <?php /** TODO: Make this section admin-configurable */ ?>
                    <div class="latest-issue">
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
                    </div>
                </a>
            </div>
            <div class="footer-links">
                <ul>
                    <?php /** TODO: Fetch footer links menu here */ ?>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact the Team</a></li>
                    <li><a href="#">Join Redbrick</a></li>
                    <li><a href="#">Community Guidelines</a></li>
                    <li><a href="#">Advertise with Redbrick</a></li>
                    <li><a href="#">Clarifications and Corrections</a></li>
                    <li><a href="/admin">Log in</a></li>
                </ul>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
