<?php get_header(); ?>
<main class="front-page">
    <?php $redbrick_posts = redbrick_get_most_recent_posts(4, ['slider-front-page']); ?>
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

    <div class="banner">
        <?php /** TODO: Make the content of `.banner` and the link here admin-configurable */ ?>
        <a href="#"><div class="content">Banner content</div></a>
    </div>

    <div class="recent-posts">

        <div class="upper">
            <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['top-stories']); ?>
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
                $redbrick_posts = redbrick_get_most_recent_posts( 5 ,
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
                                ?>
                                <!--
                                <li class="post-item"><a href="<?php echo get_permalink($post); ?>">
                                    <div class="featured-image-box">
                                        <?php
                                        if (has_post_thumbnail($redbrick_post)) {
                                            echo get_the_post_thumbnail($redbrick_post, 'post-thumbnail', ['class' => 'featured-image']);
                                        }
                                        ?>
                                        <div class="text-overlay">
                                            <h3 class="title"><?php echo esc_html(get_the_title($redbrick_post)); ?></h3>
                                        </div>
                                    </div>
                                </a></li>
                                -->
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>

            <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['comment']); ?>
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

        <?php $redbrick_posts = redbrick_get_most_recent_posts(4, ['features']); ?>
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

        <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['sport', 'uni-match-reports', 'university-features']); ?>
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

        <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['photos', 'illustration']); ?>
        <?php if (count($redbrick_posts) != 0): ?>
            <section class="posts posts--photography-and-illustration">
                <div class="constrained">
                    <h1>Photography and Illustration</h1>
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
</main>
<?php get_footer(); ?>
