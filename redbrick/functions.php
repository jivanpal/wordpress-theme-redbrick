<?php
if (!function_exists('redbrick_setup')) {
    /**
     * Set up the theme by declaring defaults and registering necessary
     * features.
     */
    function redbrick_setup() {
        add_theme_support('post_thumbnails');
    }
}
add_action('after_setup_theme', 'redbrick_setup');

if (!function_exists('redbrick_enqueue_styles_and_scripts')) {
    /**
     * Enqueue stylesheets and scripts for this theme.
     */
    function redbrick_enqueue_styles_and_scripts() {
        // Load `style.css`
        wp_enqueue_style('style', get_stylesheet_uri());

        // Load `comment-reply` script if the page requires it
        if (   !is_admin()
            && is_singular()
            && comments_open()
            && get_option('thread_comments')
        ) {
            wp_enqueue_script('comment-reply');
        }

        // Load script to correctly position the sticky/fixed header
        wp_enqueue_script(
            'redbrick_position-header',
            get_template_directory_uri() . '/scripts/position-header.js',
            ['jquery'], // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)?
        );

        // Add functionality to the hamburger icon in the header
        wp_enqueue_script(
            'redbrick_toggle-hamburger-menu',
            get_template_directory_uri() . '/scripts/toggle-hamburger-menu.js',
            [],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)?
        );

        wp_enqueue_script(
            'redbrick_overflow-shadows',
            get_template_directory_uri() . '/scripts/overflow-shadows.js',
            [],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)?
        );
    }
}
add_action('wp_enqueue_scripts', 'redbrick_enqueue_styles_and_scripts');
