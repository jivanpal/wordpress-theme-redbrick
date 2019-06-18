<?php get_header(); ?>
<main class="front-page">
    <?php $redbrick_posts = redbrick_get_latest_posts(4, ['slider-front-page']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
            <ul class="showcase">
                <?php
                foreach($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_showcase_item($redbrick_post->ID);
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php /** TODO: Make the content of `.banner` and the link here admin-configurable
    <div class="banner">
        <a href="#"><div class="content">Banner content</div></a>
    </div>
    ** END COMMENT */ ?>

    <div class="front-page-display">

        <div class="upper">
            <?php $redbrick_posts = redbrick_get_latest_posts(3, ['top-stories']); ?>
            <?php if (count($redbrick_posts) != 0): ?>
                <section class="posts posts--news">
                    <div class="constrained">
                        <h1>News</h1>
                        <ul class="post-list">
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>

            <?php
                $redbrick_posts = redbrick_get_latest_posts( 5 ,
                    [
                        'review',
                        'preview',
                        'science',
                        'album-reviews',
                        'debate-film',
                        'music-essentials',
                        'features-culture',
                        'fashion',
                        'mens',
                        'health-lifestyle',
                        'fierce-and-finished',
                        'sex-and-relationships',
                        'campus-couture',
                        'review-food-2',
                        'recipes',
                        'review-film',
                        'film-news-film',
                        'travel-news',
                        'features-travel',
                        'single-reviews',
                        'live-reviews',
                        'review-television',
                        'feature',
                        'technology-gadgets',
                        'features-tech',
                        'gadget-reviews',
                        'seasonal',
                        'restaurant',
                        'uk',
                        'abroad',
                        'tips-travel',
                        'top-five',
                        'interview-television',
                        'features-music',
                        'beauty',
                        'previews-music',
                    ]
                );
            ?>
            <?php if (count($redbrick_posts) != 0): ?>
                <section class="posts posts--latest">
                    <div class="constrained">
                        <h1>Latest</h1>
                        <ul class="post-list">
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>

            <?php $redbrick_posts = redbrick_get_latest_posts(3, ['comment']); ?>
            <?php if (count($redbrick_posts) != 0): ?>
                <section class="posts posts--comment">
                    <div class="constrained">
                        <h1>Comment</h1>
                        <ul class="post-list">
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>
        </div>

        <?php $redbrick_posts = redbrick_get_latest_posts(4, ['features']); ?>
        <?php if (count($redbrick_posts) != 0): ?>
            <section class="posts posts--features">
                <div class="constrained">
                    <h1>Features</h1>
                    <ul class="post-list">
                        <?php
                        foreach ($redbrick_posts as $redbrick_post) {
                            echo redbrick_get_html_post_item($redbrick_post);
                        }
                        ?>
                    </ul>
                </div>
            </section>
        <?php endif; ?>

        <?php $redbrick_posts = redbrick_get_latest_posts(3, ['sport', 'uni-match-reports', 'university-features']); ?>
        <?php if (count($redbrick_posts) != 0): ?>
            <section class="posts posts--sport">
                <div class="constrained">
                    <h1>Sport</h1>
                    <ul class="post-list">
                        <?php
                        foreach ($redbrick_posts as $redbrick_post) {
                            echo redbrick_get_html_post_item($redbrick_post);
                        }
                        ?>
                    </ul>
                </div>
            </section>
        <?php endif; ?>

        <?php if (class_exists('WPP_Query')) : ?>
            <?php
                /**
                 * Fetch array of popular posts using a function provided by the "WordPress Popular Posts" plugin
                 * @see https://github.com/cabrerahector/wordpress-popular-posts/issues/185
                 * @see https://github.com/cabrerahector/wordpress-popular-posts/blob/85988b63b1a7cc06f494d14e7f42feda88acfb28/src/Query.php
                 */
                $redbrick_query = new WPP_Query( [
                    'range'     => 'last7days',
                    'post_type' => 'post',
                    'order_by'  => 'views',
                    'limit'     => 3,
                ] );
                ?>
                <?php
                $redbrick_posts = redbrick_get_posts_from_wpp_query($redbrick_query);
            ?>
            <?php if (count($redbrick_posts) != 0): ?>
                <section class="posts posts--trending">
                    <div class="constrained">
                        <h2>Trending</h2>
                        <ul class="post-list">
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</main>
<?php get_footer(); ?>
