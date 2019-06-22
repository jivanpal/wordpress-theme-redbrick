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
                <img class="avatar" src="<?php echo $author_profile_picture_url; ?>"/>
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
            <div class="pagination">
                <?php posts_nav_link(); ?>
            </div>
        <?php else : ?>
            <p>This author has not written any articles.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
