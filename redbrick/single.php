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
                <?php
                    /**
                     * TODO: Fetch actual boolean value for whether the author
                     * has a profile picture set. Literal `true` or `false`
                     * used for debugging.
                     */
                    $author_has_profile_picture = true;
                ?>
                <div class="author-box">
                    <?php if ($author_has_profile_picture) : ?>
                        <?php /** TODO: Fetch actual author image here */ ?>
                        <img class="image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/alice_landray.jpg"/>
                    <?php endif; ?>
                    <div class="author-details">
                        <div class="author-name">
                            <?php if (!$author_has_profile_picture): ?>Written by<?php endif; ?>
                            <?php the_author(); ?>
                        </div>
                        <?php /** TODO: Fetch actual bio here */ ?>
                        <div class="author-bio">Food&amp;Drink Online Editor, English literature student.</div>
                    </div>
                </div>
                <div class="timestamps">
                    <div class="published">
                        <span class="label">Published</span>
                        <?php /* TODO: Fetch actual publish date */ ?>
                        at 18:00 on 4 March 2019
                    </div>
                    <?php /* TODO: if post has been modified after publish date ... */ ?>
                    <div class="modified">
                        <span class="label">Last updated</span>
                        <?php /* TODO: Fetch actual date last modified */ ?>
                        at 18:29 on 5 March 2019
                    </div>
                </div>
            </div>

            <div class="article-body">
                <?php the_content(); ?>
            </div>

            <div class="comments">
                <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
