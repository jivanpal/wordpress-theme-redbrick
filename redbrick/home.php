<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main class="fallback">
    <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
        <ul class="showcase">
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/suspiria.jpg"/>
                <div class="tint red"></div>
                <h1 class="title">Article One</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/england.jpg"/>
                <div class="tint orange"></div>
                <h1 class="title">Article Two</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/oldjoe.jpg"/>
                <div class="tint yellow"></div>
                <h1 class="title">Article Three</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/stanlee.jpg"/>
                <div class="tint green"></div>
                <h1 class="title">Article Four</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/capandgown.jpg"/>
                <div class="tint blue"></div>
                <h1 class="title">Article Five</h1>
            </a></li>
        </ul>
    </div>
    <div class="banner">
        <div class="declaration-container"><div class="declaration-content">AD</div></div>
        <?php /** TODO: Make the content of `.banner` and the link here admin-configurable */ ?>
        <a href="#"><div class="content">Banner content</div></a>
    </div>
    <?php /** TODO: Fetch some (e.g. three) articles from category "Top Stories" here */ ?>
    <?php /** TODO: Fetch some (e.g. four) articles from category "Comment" here */ ?>
    <?php /** TODO: Fetch some (e.g. four) articles from category "Features" here */ ?>
    <?php
        /**
         * TODO: Fetch some (e.g. three) articles for the "Campus Sport"
         * subsection here. These articles are fetched from the following
         * categories:
         * 
         * +---------+--------------------------+---------------------+
         * | term_id | name                     | slug                |
         * +---------+--------------------------+---------------------+
         * |    2280 | University Match Reports | uni-match-reports   |
         * |    2281 | University Features      | university-features |
         * +---------+--------------------------+---------------------+
         */
    ?>
    <?php
        /**
         * TODO: Fetch some (e.g. three) of the latest articles here. These
         * articles are fetched from a subset of all categories, namely those
         * which are in the following table:
         * 
         * +---------+---------------------+-----------------------+
         * | term_id | name                | slug                  |
         * +---------+---------------------+-----------------------+
         * |      41 | Review              | review                |
         * |      46 | Preview             | preview               |
         * |     164 | Science             | science               |
         * |    1789 | Album Reviews       | album-reviews         |
         * |    1843 | Debate              | debate-film           |
         * |    1876 | Essentials          | music-essentials      |
         * |    2263 | Features            | features-culture      |
         * |    2264 | Fashion             | fashion               |
         * |    2265 | Men's               | mens                  |
         * |    2266 | Health              | health-lifestyle      |
         * |    2267 | Fierce and Finished | fierce-and-finished   |
         * |    2268 | Relationships       | sex-and-relationships |
         * |    2269 | Campus Couture      | campus-couture        |
         * |    2270 | Review              | review-food-2         |
         * |    2271 | Recipes             | recipes               |
         * |    2275 | Review              | review-film           |
         * |    2276 | Film News           | film-news-film        |
         * |    2283 | Travel News         | travel-news           |
         * |    2284 | Features            | features-travel       |
         * |    2288 | Single Reviews      | single-reviews        |
         * |    2289 | Live Reviews        | live-reviews          |
         * |    2290 | Review              | review-television     |
         * |    2292 | Feature             | feature               |
         * |    2360 | Gadgets             | technology-gadgets    |
         * |    2361 | Features            | features-tech         |
         * |    2388 | Gadget Reviews      | gadget-reviews        |
         * |    2490 | Seasonal            | seasonal              |
         * |    2517 | Restaurant Reviews  | restaurant            |
         * |    2541 | UK                  | uk                    |
         * |    2542 | Abroad              | abroad                |
         * |    2543 | Tips                | tips-travel           |
         * |    2665 | Top Five            | top-five              |
         * |    2671 | Interview           | interview-television  |
         * |    3140 | Features            | features-music        |
         * |    3438 | Beauty              | beauty                |
         * |    3859 | Previews            | previews-music        |
         * +---------+---------------------+-----------------------+
         */
    ?>
    <?php
        /**
         * TODO: Fetch some (e.g. one) articles for the "Photography and
         * Illustration" subsection here. These articles are fetched from the
         * following categories:
         * 
         * +---------+--------------+--------------+
         * | term_id | name         | slug         |
         * +---------+--------------+--------------+
         * |   80557 | Photography  | photos       |
         * |   80558 | Illustration | illustration |
         * +---------+--------------+--------------+
         */
    ?>
    <p>This is the main body of the home page.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut molestie ex
        eleifend tellus condimentum, non lacinia urna facilisis. Mauris non
        ultricies felis. Phasellus posuere neque neque. Aliquam quis enim ut sem
        pulvinar lobortis vel quis sem. Donec nulla justo, rutrum nec nulla
        vitae, iaculis fermentum eros. Aliquam ullamcorper, purus sed hendrerit
        pharetra, eros augue finibus orci, non semper dui felis sed nulla.
        Quisque vestibulum consequat turpis. Duis aliquam arcu egestas mi
        accumsan,eget euismod diam vestibulum. Fusce quis malesuada nunc.
        Vestibulum pretium lacinia quam nec pulvinar. Vivamus vitae velit sit
        amet magna vehicula aliquet. Sed elit mi, condimentum et purus ornare,
        blandit lobortis libero. Duis viverra metus eu efficitur consequat.</p>
</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
