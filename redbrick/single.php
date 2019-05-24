<?php get_header(); ?>
<main class="post">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <div class="featured-image-box">
                <?php the_post_thumbnail('post-thumbnail', ['class' => 'featured-image']); ?>
                <div class="text-overlay">
                    <div class="constraint-container">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>

            <div class="constraint-container">
                <div class="excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="info-box">
                    <?php
                        $author_profile_picture_url = get_avatar_url(get_post());
                        $author_has_profile_picture = $author_profile_picture_url !== false;
                        $author_name = get_the_author();
                    ?>
                    <div class="author-box">
                        <?php if ($author_has_profile_picture) : ?>
                            <img class="image" src="<?php echo $author_profile_picture_url; ?>"/>
                        <?php endif; ?>
                        <div class="author-details">
                            <div class="author-name">
                                <?php if (!$author_has_profile_picture): ?>Written by<?php endif; ?>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr($author_name); ?>"><?php echo $author_name; ?></a>
                            </div>
                            <div class="author-bio"><?php the_author_meta('description'); ?></div>
                        </div>
                    </div>
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
                </div>

                <div class="post-body">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <section class="comments">
                    <div class="constraint-container">
                        <h1>Comments</h1>
                        <?php if (!comments_open()) : ?>
                            <p>Comments are closed on this page.</p>
                        <?php endif; ?>
                        <?php comments_template(); ?>
                    </div>
                </section>
            <?php endif; ?>
        </article>
    
        <aside class="recommended">
            <div class="constraint-container">
                <h1>Recommended</h1>
                <?php
                    $redbrick_primary_category = get_the_category()[0];
                    $redbrick_posts = redbrick_get_most_recent_posts(3, [ $redbrick_primary_category->slug ]);
                ?>
                <?php if (count($redbrick_posts) != 0): ?>
                    <section class="more-posts">
                        <?php
                        /**
                         * TODO: Set styling colors for class `category-xx`,
                         * where `xx` is the slug of a category.
                         */
                        ?>
                        <h2>More in
                            <span class="category category-<?php echo $redbrick_primary_category->slug; ?>">
                                <?php echo $redbrick_primary_category->name; ?>
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
                        
                <?php $redbrick_posts = redbrick_get_most_recent_posts(3, ['popular']); ?>
                <?php if (count($redbrick_posts) != 0): ?>
                    <section class="most-popular">
                        <h2>Most popular</h2>
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
        </aside>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
