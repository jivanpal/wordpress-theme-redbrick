<?php get_header(); ?>
<main class="post">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            
            <div class="infobox">
                <div class="author">
                    <div class="image"></div>
                    <div class="name"><?php the_author(); ?></div>
                </div>
                <div class="article-dates">
                    <div class="pubtime">
                        <span class="label">Published</span>
                        <?php /* TODO: Publish date ; remove example when implemented */ ?>
                        18:00 on 4 March 2019
                    </div>
                    <?php /* TODO: if post has been modified after publish date ... */ ?>
                    <div class="modtime">
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
