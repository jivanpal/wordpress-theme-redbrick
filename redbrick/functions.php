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
if (!function_exists('redbrick_shortcode_do')) {
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

if (!function_exists('redbrick_get_cat_id_from_slug')) {
    /**
     * Retrive category ID from category slug.
     * @param slug The slug of the category.
     * @return int If failure occurs or no such category exists, returns 0;
     *      else returns the ID of the category.
     */
    function redbrick_get_cat_id_from_slug($slug) {
            $category = get_term_by('slug', $slug, 'category');
            if ($category) {
                return $category->term_id;
            }
            return 0;
    }
}

if (!function_exists('redbrick_get_cat_ids_from_slug_arr')) {
    /**
     * Retrieve a list of category IDs from an array of category slugs.
     * @param slugs The array of category slugs.
     * @return string A comma-delimited string of category IDs, e.g. "32,8,7".
     *      Any categories for which there was an error determining the ID or
     *      which don't exist will not have an ID appear in the string. If no
     *      IDs are determined, the string will be empty.
     */
    function redbrick_get_cat_ids_from_slug_arr($slugs) {
        $ids = array_map('redbrick_get_cat_id_from_slug', $slugs);
        foreach ($ids as $index => $id) {
            if ($id == 0) {
                unset($ids[$index]);
            }
        }
        return implode(',' , $ids);
    }
}

if (!function_exists('redbrick_get_most_recent_posts')) {
    /**
     * Retrieve some of the most recent posts from a given set of categories.
     * @param numberposts The number of most recent posts to retrieve.
     * @param categories An array of category slugs. These categories will be
     *          searched.
     * @return array An array of `WP_Post` objects, from most recent to oldest.
     */
    function redbrick_get_most_recent_posts($numberposts, $categories) {
        $cat_ids = redbrick_get_cat_ids_from_slug_arr($categories);
        if ($cat_ids == '') {
            return [];
        }

        return get_posts( [
            'numberposts'   => $numberposts,
            'category'      => $cat_ids,
        ] );
    }
}

if (!function_exists('redbrick_get_the_author_name')) {
    /**
     * Get the name of the author of a given post.
     * @param post `WP_Post` object for the post in question.
     * @return string The display name of the author for that post. If there is
     *      no such post/author or an error occurred, returns the string "NULL".
     */
    function redbrick_get_the_author_name($post) {
        if ($post->post_author == '0') {
            return 'NULL';
        }

        $result = get_the_author_meta('display_name', $post->post_author);

        if ($result == '') {
            return 'NULL';
        }

        return $result;
    }
}

if (!function_exists('redbrick_get_html_post_item')) {
    /**
     * Get a fully generated HTML `<li class="post">...</li>` item for a given
     * post. The resulting HTML is intended for use in lists of posts, e.g. on
     * the front page, in "Read More" sections, etc.
     * @param post A `WP_Post` object for the post. This function performs no
     *      error checking, so it is the caller's responsibility to check that
     *      the provided object is not null, is well-formed, and represents a
     *      post that actually exists.
     * @return string The HTML markup for the generated list item.
     */
    function redbrick_get_html_post_item($post) {
        ob_start();
        ?>
        <li class="post"><a href="<?php echo get_permalink($post); ?>">
            <div class="featured-image-box">
                <?php
                if (has_post_thumbnail($post)) {
                    echo get_the_post_thumbnail($post, 'post-thumbnail', ['class' => 'featured-image']);
                }
                ?>
                <div class="text-overlay">
                    <h3 class="title"><?php echo esc_html(get_the_title($post)); ?></h3>
                    <div class="byline">
                        <p>
                            by <?php echo esc_html(redbrick_get_the_author_name($post)); ?>
                            <time datetime="<?php echo get_the_date('Y-m-d', $post); ?>">on <?php echo get_the_date('', $post); ?></time>
                        </p>
                    </div>
                </div>
            </div>
            <?php if (has_excerpt($post)): ?>
                <div class="excerpt">
                    <p><?php echo esc_html(get_the_excerpt($post)); ?></p>
                </div>
            <?php endif; ?>
        </a></li>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_get_html_showcase_item')) {
    /**
     * Get a fully generated HTML `<li class="showcase-item">...</li>` item for
     * a given post. The resulting HTML is intended for use in the sliders on
     * category pages and the front page.
     * @param post A `WP_Post` object for the post. This function performs no
     *      error checking, so it is the caller's responsibility to check that
     *      the provided object is not null, is well-formed, and represents a
     *      post that actually exists.
     * @return string The HTML markup for the generated list item.
     */
    function redbrick_get_html_showcase_item($post) {
        ob_start();
        ?>
        <li class="showcase-item">
            <a href="<?php echo get_permalink($post); ?>">
                <?php echo get_the_post_thumbnail($post, 'post-thumbnail', ['class' => 'featured-image']); ?>
                <?php
                /**
                 * TODO: Set up tint colour based on permalink section;
                 * test colours are 'red', 'orange', 'yellow', 'green', 'blue'
                 */
                ?>
                <div class="tint blue"></div>
                <div class="text-overlay">
                    <h1 class="title"><?php echo esc_html(get_the_title($post)); ?></h1>
                </div>
            </a>
        </li>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_put_yoast_primary_cat_first')) {
    /**
     * Given an array of the categories for a post, move the primary category
     * for that post to the front of the array. The primary category feature is
     * implemented by the Yoast SEO plugin. If this plugin is not installed or
     * activated, the list of categories remains unchanged.
     * 
     * This filter allows the primary category for an arbitrary post to be found
     * simply with `get_the_category($post_id)[0]`; for the global `$post`
     * object, you can use `get_the_category()[0]`.
     * 
     * @see https://joshuawinn.com/using-yoasts-primary-category-in-wordpress-theme/#comment-107849
     * 
     * @param array $categories An array of all the categories that the post
     *          belongs to.
     * @param int|bool $post_id The ID of the post whose categories we're
     *          dealing with. If unspecified or set to `0` or `false`, the ID
     *          of the post represented by the global `$post` object is used. 
     */
    function redbrick_filter_primary_category_first($categories, $post_id) {
        if (!$post_id) {
            $post_id = get_the_id();
        }

        /**
         * If the Yoast plugin exists (as indicated by the presense of the
         * `WPSEO_Primary_Term` class) ...
         */
        if ($categories && class_exists('WPSEO_Primary_Term')) {
            // Attempt to get the primary category as given by Yoast;
            // result is `false` if no such category or an error occurs.
            $primary_cat_id = (new WPSEO_Primary_Term('category', $post_id))->get_primary_term();

            if ($primary_cat_id) {
                // Make primary category the first entry in the array
                foreach ($categories as $index => $category) {
                    if ($category->term_id === $primary_cat_id) {
                        $primary_cat_arr = array_splice($categories, $index, 1);
                        array_splice($categories, 0, 0, $primary_cat_arr);
                        break;
                    }
                }
            }
        }
        
        return $categories;
    }
}
add_filter('get_the_categories', 'redbrick_filter_primary_category_first');
