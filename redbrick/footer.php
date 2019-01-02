        <footer>
            <div class="container">
                <div class="popular-articles">
                    <h1>Most Popular</h1>
                    <ul>
                        <?php /** TODO: Fetch popular articles here */ ?>
                        <li><a href="#">Article One</a></li>
                        <li><a href="#">Article Two</a></li>
                    </ul>
                </div>
                <div class="social-media">
                    <h1>Connect</h1>
                    <ul>
                        <?php /** TODO: Fetch social media menu here */ ?>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
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
                            <div class="temp-container"> <?php /** TODO: Remove container when done testing */ ?>
                            <img id="lastest-issue-thumbnail" src="#"/>
                            </div>
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
