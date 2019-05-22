<?php get_header(); ?>
<?php
    $category_id    = get_queried_object_id();
    $category_slug  = get_queried_object()->slug;
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

    <?php $redbrick_categories = get_categories(['child_of' => $category_id]); ?>
    <?php if (count($redbrick_categories) != 0): ?>
        <section class="subsections section-<?php echo $category_slug; ?>">
            <ul class="category-list">
                <?php
                foreach ($redbrick_categories as $redbrick_category) {
                    echo redbrick_get_html_category_item($redbrick_category);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php $redbrick_posts = redbrick_get_most_recent_posts(12, [ $category_slug ]); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <section class="posts section-<?php echo $category_slug; ?>">
            <ul class="post-list">
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
