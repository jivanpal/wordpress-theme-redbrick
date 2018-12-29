<?php
add_theme_support('post_thumbnails');

function enqueue_theme_styles_and_scripts() {
    // Load `style.css`
    wp_enqueue_style('style', get_stylesheet_uri());

    // Load `comment-reply` script if the page requires it
    if ( !is_admin()
        && is_singular()
        && comments_open()
        && get_option('thread_comments')
    ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action('wp_enqueue_scripts', 'enqueue_theme_styles_and_scripts');
