<?php get_header(); ?>
<main class="author">
    <?php
        global $wp_query;
        $author = $wp_query->get_queried_object();
        $author_profile_picture_url = get_avatar_url($author->ID);
        $author_has_profile_picture = $author_profile_picture_url !== false;
        $author_name = $author->display_name;
    ?>
    <div class="constrained">
        <div class="author-box">
            <?php if ($author_has_profile_picture) : ?>
                <img class="image" src="<?php echo $author_profile_picture_url; ?>"/>
            <?php endif; ?>
            <div class="author-details">
                <div class="author-name"><?php echo $author_name; ?></div>
                <div class="author-bio"><?php the_author_meta('description'); ?></div>
            </div>
        </div>
        
        <?php if (have_posts()) : ?>
            <ul class="post-list">
            <?php
                while(have_posts()) {
                    the_post();
                    echo redbrick_get_html_post_item(get_post());
                }
            ?>
            </ul>
        <?php else : ?>
            <p><?php _e('No posts by this author.'); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
