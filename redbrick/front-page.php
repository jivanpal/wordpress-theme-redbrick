<?php get_header(); ?>
<main class="home">
    <?php $redbrick_posts = redbrick_get_most_recent_posts(4, ['slider-front-page']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
            <ul class="showcase">
                <?php
                foreach($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_showcase_item($redbrick_post);
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="banner">
        <?php /** TODO: Make the content of `.banner` and the link here admin-configurable */ ?>
        <a href="#"><div class="content">Banner content</div></a>
    </div>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['top-stories']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="top-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(4, ['comment']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="comment-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(4, ['features']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="featured-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['uni-match-reports', 'university-features']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="sport-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php
        $redbrick_posts = redbrick_get_most_recent_posts( 3 ,
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
        <section class="other-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['photos', 'illustration']); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="photography-posts">
            <ul>
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_post_item($redbrick_post);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
