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
    <?php endwhile; ?>
    
    <aside class="recommended">
        <div class="constraint-container">
            <h1>Recommended</h1>

            <section class="more-posts">
                <h2>More in <span class="category tv" style="color: #0c0;">TV</span></h2>
                <ul>
                    <li class="post">
                        <div class="featured-image-box">
                            <?php /* TODO: get the featured image */ ?>
                            <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                            <div class="text-overlay">
                                <h3 class="title"><?php /* TODO: get the title */ echo 'Example title' ?></h3>
                                <div class="byline">
                                    <?php /* TODO: get the actual author name and publish time */ ?>
                                    <p>by Jivan Pal <time datetime="2019-03-05">on 5 March 2019</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="excerpt">
                            <?php /** TODO: get the excerpt */ ?>
                            <p>This is an example of an excerpt for an article. Read the article for more.</p>
                        </div>
                    </li>
                    <li class="post">
                        <div class="featured-image-box">
                            <?php /* TODO: get the featured image */ ?>
                            <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                            <div class="text-overlay">
                                <h3 class="title"><?php /* TODO: get the title */ echo 'Example title' ?></h3>
                                <div class="byline">
                                    <?php /* TODO: get the actual author name and publish time */ ?>
                                    <p>by Jivan Pal <time datetime="2019-03-05">on 5 March 2019</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="excerpt">
                            <?php /** TODO: get the excerpt */ ?>
                            <p>This is an example of an excerpt for an article. Read the article for more.</p>
                        </div>
                    </li>
                </ul>
            </section>

            <section class="most-popular">
                <h2>Most popular</h2>
                <ul>
                    <li class="post">
                        <div class="featured-image-box">
                            <?php /* TODO: get the featured image */ ?>
                            <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                            <div class="text-overlay">
                                <h3 class="title"><?php /* TODO: get the title */ echo 'Example title' ?></h3>
                                <div class="byline">
                                    <?php /* TODO: get the actual author name and publish time */ ?>
                                    <p>by Jivan Pal <time datetime="2019-03-05">on 5 March 2019</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="excerpt">
                            <?php /** TODO: get the excerpt */ ?>
                            <p>This is an example of an excerpt for an article. Read the article for more.</p>
                        </div>
                    </li>
                    <li class="post">
                        <div class="featured-image-box">
                            <?php /* TODO: get the featured image */ ?>
                            <img class="featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/featured-image.jpg"/>
                            <div class="text-overlay">
                                <h3 class="title"><?php /* TODO: get the title */ echo 'Example title' ?></h3>
                                <div class="byline">
                                    <?php /* TODO: get the actual author name and publish time */ ?>
                                    <p>by Jivan Pal <time datetime="2019-03-05">on 5 March 2019</time></p>
                                </div>
                            </div>
                        </div>
                        <div class="excerpt">
                            <?php /** TODO: get the excerpt */ ?>
                            <p>This is an example of an excerpt for an article. Read the article for more.</p>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </aside>
</main>
<?php get_footer(); ?>
