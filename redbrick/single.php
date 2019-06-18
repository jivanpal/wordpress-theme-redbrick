<?php get_header(); ?>
<main class="post">
    <?php while (have_posts()) : the_post(); ?>
        <?php
            $redbrick_post_id = get_the_ID();
            $redbrick_topmost_category = redbrick_get_topmost_category_of_post($redbrick_post_id);
        ?>
        <div class="featured-image-box">
            <?php the_post_thumbnail('post-thumbnail', ['class' => 'featured-image']); ?>
            <div class="text-overlay">
                <div class="constrained">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
            
        <div class="grid-container">
            <article class="section--<?php echo $redbrick_topmost_category->slug; ?>">
                <div class="constrained">
                    <div class="excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <div class="info-box">
                        <?php echo redbrick_get_html_author_box(); ?>
                        <div class="timestamps">
                            <div class="publish-time">
                                <span class="label">Published</span>
                                <time datetime="<?php the_time('c'); ?>">at <?php the_time(); ?> on <?php the_date(); ?></time>
                            </div>
                            <?php $seconds_between_publish_and_last_modification = ((int)get_the_modified_time('U')) - ((int)get_the_time('U')); ?>
                            <?php if ($seconds_between_publish_and_last_modification > 0): ?>
                                <div class="update-time">
                                    <span class="label">Last updated</span>
                                    <time datetime="<?php the_modified_time('c'); ?>">at <?php the_modified_time(); ?> on <?php the_modified_date(); ?></time>
                                </div>
                            <?php endif; ?>
                        </div>
                            <?php echo redbrick_get_html_photographer_credits($redbrick_post_id); ?>
                        </div>

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <section class="comments">
                    <div class="constrained">
                        <h1>Comments</h1>
                        <?php if (!comments_open()) : ?>
                            <p>Comments are closed on this page.</p>
                        <?php endif; ?>
                        <?php comments_template(); ?>
                    </div>
                </section>
            <?php endif; ?>
        
            <aside class="recommended">
                <div class="constrained">
                    <h1>Recommended</h1>
                    <?php $redbrick_posts = redbrick_get_latest_posts(3, [ $redbrick_topmost_category->slug ], [$redbrick_post_id]); ?>
                    <?php if (count($redbrick_posts) != 0): ?>
                        <section class="more-posts">
                            <h2>More in
                                <span class="category section--<?php echo $redbrick_topmost_category->slug; ?>">
                                    <?php echo $redbrick_topmost_category->name; ?>
                                </span>
                            </h2>
                            <ul class="post-list">
                                <?php
                                foreach ($redbrick_posts as $redbrick_post) {
                                    echo redbrick_get_html_post_item($redbrick_post);
                                }
                                ?>
                            </ul>
                        </section>
                    <?php endif; ?>
                    
                    <?php if (class_exists('WPP_Query')) : ?>
                        <?php
                            /**
                             * Fetch array of popular posts using a function provided by the "WordPress Popular Posts" plugin
                             * @see https://github.com/cabrerahector/wordpress-popular-posts/issues/185
                             * @see https://github.com/cabrerahector/wordpress-popular-posts/blob/85988b63b1a7cc06f494d14e7f42feda88acfb28/src/Query.php
                             */
                            $redbrick_query = new WPP_Query( [
                                'range'     => 'last7days',
                                'post_type' => 'post',
                                'order_by'  => 'views',
                                'limit'     => 3,
                            ] );
                            ?>
                            <?php
                            $redbrick_posts = redbrick_get_posts_from_wpp_query($redbrick_query);
                        ?>
                        <?php if (count($redbrick_posts) != 0): ?>
                            <section class="most-popular">
                                <h2>Most popular this week</h2>
                                <ul class="post-list">
                                    <?php
                                    foreach ($redbrick_posts as $redbrick_post) {
                                        echo redbrick_get_html_post_item($redbrick_post);
                                    }
                                    ?>
                                </ul>
                            </section>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
