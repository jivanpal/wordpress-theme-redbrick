<?php get_header(); ?>
<main class="post">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <div class="featured-image-box">
                <?php /** TODO: Fetch actual post thumbnail here */ ?>
                <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                <div class="text-overlay">
                    <div class="constraint-container">
                        <h1 class="title"><?php the_title(); ?></h1>
                        <div class="excerpt"><?php the_excerpt(); ?></div>
                    </div>
                </div>
            </div>

            <div class="constraint-container">
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
                        <div class="publish-time">
                            <span class="label">Published</span>
                            <?php /* TODO: Fetch actual publish date */ ?>
                            <time datetime="2019-03-04T18:00Z">at 18:00 on 4 March 2019</time>
                        </div>
                        <?php /* TODO: if post has been modified after publish date ... */ ?>
                        <div class="update-time">
                            <span class="label">Last updated</span>
                            <?php /* TODO: Fetch actual date last modified */ ?>
                            <time datetime="2019-03-05T18:29Z">at 18:29 on 5 March 2019</time>
                        </div>
                    </div>
                </div>

                <div class="post-body">
                    <?php the_content(); ?>
                </div>
            </div>

            <section class="comments">
                <div class="constraint-container">
                    <h1>Comments</h1>
                    <p>This is where comments will appear.</p>
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                </div>
            </section>
        </article>
    
    
        <aside class="recommended">
            <div class="constraint-container">
                <h1>Recommended</h1>

                <?php $redbrick_posts = redbrick_get_most_recent_posts(3, [ get_the_category()[0] ]); ?>
                <?php if (count($redbrick_posts) != 0): ?>
                    <section class="more-posts">
                        <h2>More in <span class="category tv" style="color: #0c0;">TV</span></h2>
                        <ul>
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['popular']); ?>
                <?php if (count($redbrick_posts) != 0): ?>
                    <section class="most-popular">
                        <h2>Most popular</h2>
                        <ul>
                            <?php
                            foreach ($redbrick_posts as $redbrick_post) {
                                echo redbrick_get_html_post_item($redbrick_post);
                            }
                            ?>
                        </ul>
                    </section>
                <?php endif; ?>
            </div>
        </aside>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
