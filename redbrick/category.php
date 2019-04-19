<?php get_header(); ?>
<?php
    $category_slug = get_queried_object()->slug;
?>
<main class="category">
    <?php $redbrick_posts = redbrick_get_most_recent_posts(4, [ 'slider-' . $category_slug ]); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
            <ul class="showcase">
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_showcase_item($redbrick_post);
                }
                ?>
            </ul>
        </div>
    <? endif; ?>
</main>
<?php get_footer(); ?>
