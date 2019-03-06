<?php get_header(); ?>
<main class="post">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <div class="featured-image-box">
                <?php /** TODO: Fetch actual post thumbnail here */ ?>
                <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                <div class="text-overlay">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <div class="post-excerpt"><?php the_excerpt(); ?></div>
                </div>
            </div>

            <div class="info-box">
                <div class="author-box">
                    <?php /** TODO: Fetch actual author image here */ ?>
                    <img class="image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/alice_landray.jpg"/>
                    <div class="author-details">
                        <div class="author-name"><?php the_author(); ?></div>
                        <?php /** TODO: Fetch actual bio here */ ?>
                        <div class="author-bio">Food&amp;Drink Online Editor, English literature student.</div>
                    </div>
                </div>
                <div class="timestamps">
                    <div class="published">
                        <span class="label">Published</span>
                        <?php /* TODO: Publish date ; remove example when implemented */ ?>
                        18:00 on 4 March 2019
                    </div>
                    <?php /* TODO: if post has been modified after publish date ... */ ?>
                    <div class="modified">
                        <span class="label">Last updated</span>
                        <?php /* TODO: Date last modified ; remove example when implemented */ ?>
                        18:29 on 5 March 2019
                    </div>
                </div>
            </div>

            <?php the_content(); ?>
        </article>
        <div class="comments">
            <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            ?>
        </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
