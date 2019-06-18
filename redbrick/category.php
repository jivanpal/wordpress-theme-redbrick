<?php get_header(); ?>
<?php
    $redbrick_category_id    = get_queried_object_id();
    $redbrick_category_slug  = get_queried_object()->slug;
?>
<main class="category">
    <?php $redbrick_posts = redbrick_get_latest_posts(4, [ 'slider-' . $redbrick_category_slug ]); ?>
    <?php if (count($redbrick_posts) != 0): ?>
        <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
            <ul class="showcase">
                <?php
                foreach ($redbrick_posts as $redbrick_post) {
                    echo redbrick_get_html_showcase_item($redbrick_post->ID);
                }
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php
        $redbrick_categories = get_categories(['child_of' => $redbrick_category_id]);
        // Remove categories whose slugs begin with `slider-`, if they are present
        foreach ($redbrick_categories as $redbrick_array_key => $redbrick_category) {
            if (preg_match('/^slider-/', $redbrick_category->slug) !== 0) {
                unset($redbrick_categories[$redbrick_array_key]);
            }
        }
    ?>
    <?php if (count($redbrick_categories) != 0): ?>
        <section class="subsections section--<?php echo $redbrick_category_slug; ?>">
            <ul class="category-list">
                <?php
                foreach ($redbrick_categories as $redbrick_category) {
                    echo redbrick_get_html_category_item($redbrick_category);
                }
                ?>
            </ul>
        </section>
    <?php endif; ?>

    <div class="constrained">
        <?php $redbrick_posts = redbrick_get_latest_posts(12, [ $redbrick_category_slug ]); ?>
        <?php if (count($redbrick_posts) != 0): ?>
            <section class="posts section-<?php echo $redbrick_category_slug; ?>">
                <ul class="post-list">
                    <?php 
                    foreach ($redbrick_posts as $redbrick_post) {
                        echo redbrick_get_html_post_item($redbrick_post);
                    }
                    ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
