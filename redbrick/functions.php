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
        // Load main stylesheet `style.css`
        wp_enqueue_style(
            'style',
            get_stylesheet_uri(),
            [],     // dependencies
            time()  // version number // TODO: set actual version number rather than `time()`
        );

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
            time(),     // version number // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        // Add functionality to submenu items and back buttons in the navigation menu
        wp_enqueue_script(
            'redbrick_handle-navigation-menus',
            get_template_directory_uri() . '/scripts/handle-navigation-menus.js',
            [ 'redbrick_toggle-hamburger-menu' ],         // dependencies
            time(),     // version number // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );
        
        // Add functionality to the hamburger icon in the header
        wp_enqueue_script(
            'redbrick_toggle-hamburger-menu',
            get_template_directory_uri() . '/scripts/toggle-hamburger-menu.js',
            [],         // dependencies
            time(),     // version number // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        // Add functionality to the search icon in the header
        wp_enqueue_script(
            'redbrick_toggle-search-bar',
            get_template_directory_uri() . '/scripts/toggle-search-bar.js',
            [],         // dependencies
            time(),     // version number // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );

        
    }
}
add_action('wp_enqueue_scripts', 'redbrick_enqueue_styles_and_scripts');

/** TODO: Implement styles for Guild Council Motions, YouTube, and text boxes */
if(!function_exists('redbrick_shortcode_do')) {
    /**
     * Implements legacy `do` shortcode used in older articles, whose
     * functionality was previously implemented by a plugin (Shortcodes Pro
     * by Matt Varone) that is no longer maintained.
     * 
     * @see https://wordpress.org/plugins/shortcodes-pro/
     */
    function redbrick_shortcode_do($atts) {
        /**
         * Attributes are as follows:
         * 
         * • `action` is one of the following:
         *   • `box` — for a text box with a title
         *   • `guild-council-motions` — template for Guild Council Motion entries
         *   • `shortcode` — for pullquotes
         *   • `youtube` — for YouTube embeds
         * 
         * Attributes for `action = box`:
         *   • `title` — the title for the text box
         *   • `text` — the text inside the text box
         *   • `align` — the float for the text box. Its value is one of:
         *       • `fullwidth` — no float, the box spans the full width of the
         *           column it resides in
         *       • `left` — float left
         *       • `right` — float right
         * 
         *  Attributes for `action = guild-council-motions`:
         *   • `title` — title for the motion.
         *   • `proposer` — person who proposed the motion
         *   • `summary` — summary of the motion
         *   • `status` — status of the motion. Its value is one of:
         *       • ` ` (single space character) — "Motion to be discussed"
         *       • `thumbs-o-up` — "Motion passed"
         *       • `thumbs-o-down` — "Motion rejected"
         *       • `times-circle` — "Motion withdrawn"
         *       • `calendar` — "Motion deferred"
         * 
         * • Attributes for `action = shortcode`:
         *   • `quote` — the text for the pullquote
         *   • `section` — the slug of the newspaper section whose colour should
         *       be used for the text; this is actually ignored (since the style
         *       guide dictates that the colour of the section to which the
         *       article belongs should be used) but is kept here for
         *       documentation's sake.
         *   • `align` — the float for the quote. Its value is one of:
         *       • `fullwidth` — no float, the text spans the full width of the
         *           column it resides in
         *       • `left` — float left
         *       • `right` — float right
         *   • `size` — the size of the pullquote text. Its value is one of:
         *       • `normal`
         *       • `small`
         *       • `smallest`
         * 
         * Attributes for `action = youtube`:
         *   • `id` — the YouTube video ID, as seen in the query string's `v`
         *       attribute's value, e.g. in the URLs `https://www.youtube.com/watch?v=orkYm6o6B8s&list=RDAEiQ8UGWDWY&index=2`
         *       and `https://youtu.be/orkYm6o6B8s`, the video ID is `orkYm6o6B8s`.
         *   • `align` — the float for the video embed. Its value is one of:
         *       • `fullwidth` — no float, the embed spans the full width of the
         *           column it resides in
         *       • `left` — float left
         *       • `right` — float right
         */

        $atts = shortcode_atts(
            [   /** Array containing all legal attribute keys and their default values (here 'NULL' for compatibility */
                'action'    => 'NULL',
                'align'     => 'NULL',
                'id'        => 'NULL',
                'proposer'  => 'NULL',
                'quote'     => 'NULL',
                'section'   => 'NULL',
                'size'      => 'NULL',
                'status'    => 'NULL',
                'summary'   => 'NULL',
                'text'      => 'NULL',
                'title'     => 'NULL',
            ],
            $atts,
            'do'
        );

        if ($atts['action'] == 'box') {
            ob_start();
            ?>
            <div class="box <?php echo $atts['align']; ?>">
                <h2><?php echo $atts['title']; ?></h2>
                <?php echo $atts['text']; ?>
            </div>'
            <?php
            return ob_get_clean();
        }

        if ($atts['action'] == 'guild-council-motions') {
            ob_start();
            ?>
            <dt>
                <div style="display: inline-block; max-width: 90%;">
                    <?php echo $atts['title']; ?>
                </div>
                <div style="float: right; display: inline-block; padding-right: 5px; box-sizing: border-box; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;">
                    <i class="fa fa-<?php echo $atts['status']; ?>"></i>
                </div>
            </dt>
            <dd>
                <b>Proposed by:</b> <?php echo $atts['proposer']; ?>
                <br />
                <b>Summary:</b> <?php echo $atts['summary']; ?>
            </dd>
            <?php
            return ob_get_clean();
        }
        
        if ($atts['action'] == 'shortcode') {
            if ($atts['quote'] == 'NULL') {
                return '';
            }
            $class_section  = $atts['section'] == 'NULL'                                    ? ' '            : (' section-' . $atts['section']);
            $class_float    = $atts['align']   == 'NULL' || $atts['align'] == 'fullwidth'   ? ''             : (' float-'   . $atts['align']);
            $class_size     = $atts['size']    == 'NULL'                                    ? ' size-normal' : (' size-'    . $atts['size']);
            
            ob_start();
            ?> 
            <figure class="wp-block-pullquote<?php echo $class_section . $class_float . $class_size; ?>">
                <blockquote>
                    <div class="opening-quotemark">“</div>
                    <p><?php echo $atts['quote']; ?></p>
                </blockquote>
            </figure>
            <?php
            return ob_get_clean();
        }
        
        if ($atts['action'] == 'youtube') {
            ob_start();
            ?>
            <div class="<?php echo $atts['align']; ?> youtube<?php echo $atts['align']; ?>">
                <iframe
                    width="100%"
                    height="100%"
                    src="https://www.youtube.com/embed/<?php echo $atts['id']; ?>?rel=0"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
            <?php
            return ob_get_clean();
        }
        
    }
}
add_shortcode('do', 'redbrick_shortcode_do');
