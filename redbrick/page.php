<?php get_header(); ?>
<main class="static-page">
    <?php while (have_posts()) : the_post(); ?>
        <article>
            <div class="featured-image-box">
                <?php the_post_thumbnail('post-thumbnail', ['class' => 'featured-image']); ?>
                <div class="text-overlay">
                    <div class="constrained">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>

            <div class="constrained">
                <div class="post-body">
                    <?php the_content(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>

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
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
