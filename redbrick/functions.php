<?php
if (!function_exists('redbrick_setup')) {
    /**
     * Set up the theme by declaring defaults and registering necessary
     * features.
     */
    function redbrick_setup() {
        add_theme_support( 'html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption'] );
        add_theme_support( 'post_thumbnails' );
        add_theme_support( 'title-tag' );
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

        // Add scrolling shadows to some scrollable elements
        wp_enqueue_script(
            'redbrick_overflow-shadows',
            get_template_directory_uri() . '/scripts/overflow-shadows.js',
            [],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        // Add functionality to submenu items and back buttons in the navigation menu
        wp_enqueue_script(
            'redbrick_handle-navigation-menus',
            get_template_directory_uri() . '/scripts/handle-navigation-menus.js',
            [ 'redbrick_toggle-hamburger-menu' ],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );
        
        // Add functionality to the hamburger icon in the header
        wp_enqueue_script(
            'redbrick_toggle-hamburger-menu',
            get_template_directory_uri() . '/scripts/toggle-hamburger-menu.js',
            [],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        // Add functionality to the search icon in the header
        wp_enqueue_script(
            'redbrick_toggle-search-bar',
            get_template_directory_uri() . '/scripts/toggle-search-bar.js',
            [],         // dependencies
            time(),     // version  // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        
    }
}
add_action('wp_enqueue_scripts', 'redbrick_enqueue_styles_and_scripts');

if(!function_exists('redbrick_shortcode_do')) {
    /**
     * Implements legacy `do` shortcode used in older articles, whose
     * functionality was previously implemented by a plugin (Shortcodes Pro
     * by Matt Varone) that is no longer maintained.
     * 
     * @see https://wordpress.org/plugins/shortcodes-pro/
     */
    function redbrick_shortcode_do($atts) {
        $atts = shortcode_atts( ['action' => 'NULL', 'quote' => 'NULL'], $atts, 'do');
        
        if ($atts['action'] != 'shortcode') {
            return '';
        }

        if ($atts['quote'] != 'NULL') {
            ob_start();
            ?> 
            <figure class="wp-block-pullquote">
                <blockquote>
                    <div class="opening-quotemark">“</div>
                    <p><?php echo $atts['quote']; ?></p>
                </blockquote>
            </figure>
            <?php
            return ob_get_clean();
        }
    }
}
add_shortcode('do', 'redbrick_shortcode_do');
