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

        // Add opening quotemarks to pullquotes
        wp_enqueue_script(
            'redbrick_add-opening-quotemarks',
            get_template_directory_uri() . '/scripts/add-opening-quotemarks.js',
            [],         // dependencies
            time(),     // version number // TODO: set actual version number rather than `time()`
            true        // enqueue in footer (rather than head)
        );
    }
}
add_action('wp_enqueue_scripts',    'redbrick_enqueue_styles_and_scripts');
add_action('login_enqueue_scripts', 'redbrick_enqueue_styles_and_scripts');

if (!function_exists('redbrick_set_login_headerurl')) {
    /**
     * A filter for the `login_headerurl` hook that sets the hyperlink target
     * of the icon on the login page to `/` (the homepage).
     */
    function redbrick_set_login_headerurl($login_header_url) {
        return '/';
    }
}
add_filter('login_headerurl', 'redbrick_set_login_headerurl');

if (!function_exists('rebrick_set_login_headertext')) {
    function redbrick_set_login_headertext($login_header_text) {
        return file_get_contents(get_template_directory() . '/assets/redbrick-icon.svg');
    }
}
add_filter('login_headertext', 'redbrick_set_login_headertext');

if (!function_exists('redbrick_set_login_message')) {
    /**
     * A filter for the `login_message` hook that set the message on the
     * login page as appropriate.
     */
    function redbrick_set_login_message($message) {
        if ($message == '') {
            ob_start(); ?>
            <p class="message login">Log in to Redbrick</p>
            <?php $message = ob_get_clean();
        } else if (preg_match( '/^\<p class\=\"message register\"\>/', $message) === 1) {
            ob_start(); ?>
            <p class="message register">Create a Redrick account</p>
            <?php $message = ob_get_clean();
        }
        return $message;
    }
}
add_filter('login_message', 'redbrick_set_login_message');

/** TODO: Implement CSS styles for Guild Council Motions, YouTube, and text boxes; see HTML given here for reference */
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
            [   /** Array containing all legal attribute keys and their default values (here 'NULL' for compatibility) */
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
                    <p><?php echo $atts['quote']; ?></p>
                </blockquote>
            </figure>
            <?php
            return ob_get_clean();
        }
        
        if ($atts['action'] == 'youtube') {
            ob_start();
            ?>
            <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube">
                <div class="wp-block-embed__wrapper">
                    <span class="embed-youtube" style="text-align: center; display: block;">
                        <iframe class="youtube-player"
                                type="text/html" width="500"
                                height="282"
                                src="https://www.youtube.com/embed/<?php echo $atts['id']; ?>?version=3&amp;rel=1&amp;fs=1&amp;autohide=2&amp;showsearch=0&amp;showinfo=1&amp;iv_load_policy=1&amp;wmode=transparent"
                                allowfullscreen="true"
                                style="border: 0;">
                        </iframe>
                    </span>
                </div>
            </figure>
            <?php
            return ob_get_clean();
        }
        
    }
}
add_shortcode('do', 'redbrick_shortcode_do');

if (!function_exists('redbrick_get_cat_id_from_slug')) {
    /**
     * Retrive category ID from category slug.
     * @param string $slug The slug of the category.
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
     * Retrieve a string of category IDs from an array of category slugs.
     * @param string[] $slugs The array of category slugs.
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

if (!function_exists('redbrick_get_latest_posts')) {
    /**
     * Retrieve some of the most recent posts from a given set of categories.
     * @param int $numberposts The number of most recent posts to retrieve.
     * @param string[] $categories An array of category slugs. These categories
     *          will be searched.
     * @param int[] $excluded_posts An array of post IDs that should not be
     *          fetched. Useful for preventing the current post from being
     *          returned in the results. Default is an empty array,
     *          i.e. no excluded posts.
     * @return WP_Post[] The recent posts, from most recent to oldest.
     */
    function redbrick_get_latest_posts($numberposts, $categories, $excluded_posts = []) {
        $cat_ids = redbrick_get_cat_ids_from_slug_arr($categories);
        if ($cat_ids == '') {
            return [];
        }

        return get_posts( [
            'numberposts'   => $numberposts,
            'category'      => $cat_ids,
            'post__not_in'  => $excluded_posts,
        ] );
    }
}

if (!function_exists('redbrick_get_the_author_name')) {
    /**
     * Get the name of the author of a given post.
     * @param WP_Post $post An object for the post in question.
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
     * @param WP_Post $post An object for the post. This function performs no
     *      error checking, so it is the caller's responsibility to check that
     *      the provided object is not null, is well-formed, and represents a
     *      post that actually exists.
     * @return string The HTML markup for the generated list item.
     */
    function redbrick_get_html_post_item($post) {
        ob_start();
        ?>
        <li class="post-item"><a href="<?php echo get_permalink($post); ?>">
            <div class="featured-image-box">
                <?php
                if (has_post_thumbnail($post)) {
                    echo get_the_post_thumbnail($post, 'post-thumbnail', ['class' => 'featured-image']);
                }
                ?>
                <div class="text-overlay">
                    <h3 class="title"><?php echo esc_html(get_the_title($post)); ?></h3>
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
     * @param int $post_id The ID of the post. If the ID is invalid, behaviour
     *          is undefined.
     * @return string The HTML markup for the generated list item.
     */
    function redbrick_get_html_showcase_item($post_id) {
        ob_start();
        ?>
        <li class="showcase-item">
            <a href="<?php echo get_permalink($post_id); ?>">
                <?php echo get_the_post_thumbnail($post_id, 'post-thumbnail', ['class' => 'featured-image']); ?>
                <div class="tint section--<?php echo redbrick_get_topmost_category_of_post($post_id)->slug; ?>"></div>
                <div class="text-overlay">
                    <h1 class="title"><?php echo esc_html(get_the_title($post_id)); ?></h1>
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
     * @param WP_Term[] $categories An array of all the categories that the
     *          post belongs to.
     * @param int|bool $post_id The ID of the post whose categories we're
     *          dealing with. If unspecified or set to `0` or `false`, the ID
     *          of the post represented by the global `$post` object is used.
     * @return WP_Term[] The array `$categories`, but with the primary category
     *          of the post with ID `$post_id` as the first element.
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
add_filter('get_the_categories', 'redbrick_filter_primary_category_first', 100, 2);

if (!function_exists('redbrick_get_html_category_item')) {
    /**
     * Get a fully generated HTML `<li class="category">...</li>` item for a
     * given category. The resulting HTML is intended for use in lists of
     * categories, e.g. in the list of subsections on a section's main page.
     * @param WP_Term $category An object for the category. This function
     *      performs no error checking, so it is the caller's responsibility to
     *      check that the provided object is not null, is well-formed, and
     *      represents a category that actually exists.
     * @return string The HTML markup for the generated list item.
     */
    function redbrick_get_html_category_item($category) {
        ob_start();
        ?>
        <li class="category">
            <a href="<?php echo get_category_link($category); ?>">
                <span><?php echo esc_html($category->name); ?></span>
            </a>
        </li>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_register_menus')) {
    /**
     * Register the custom header and footer navigation menus with WordPress.
     */
    function redbrick_register_menus() {
        register_nav_menus( [
            'redbrick_nav_menu_header'  => 'Header Menu',
            'redbrick_nav_menu_footer'  => 'Footer Menu',
        ] );
    }
}
add_action('init', 'redbrick_register_menus');

if (!function_exists('redbrick_get_nav_menu_object_at_location')) {
    /**
     * Get the navigation menu object for the menu which is assigned to a given
     * navigation menu location.
     * @param string $nav_menu_location The name of the navigation menu
     *          location to fetch the menu from.
     * @return WP_Term|false The menu object; `false` if no such menu or an
     *          error occurs.
     */
    function redbrick_get_nav_menu_object_at_location($nav_menu_location) {
        $locations = get_nav_menu_locations();
        if (isset($locations[$nav_menu_location])) {
            return wp_get_nav_menu_object($locations[$nav_menu_location]);
        }
        return false;
    }
}

if (!function_exists('redbrick_build_array_tree')) {
    /**
     * Build a tree-like structure of the items in an array.
     * @param WP_Post[] $elements The array of items from which to generate the
     *          tree. Each item must have a field `int ID`, and a field
     *          `int menu_item_parent` which is set to the ID of its parent item
     *          as seen in this array (or set to `0` if the item is a
     *          top-level item). The array will be modified in place for
     *          efficiency, i.e. this operation is destructive (and will reduce
     *          a fully-formed array to an empty array) so create a copy
     *          of `$elements` beforehand if necessary.
     * @param int $parent_id Ignore this parameter; it is used internally by
     *          this function since it is recursive in nature. (The ID of the
     *          parent item for the branch we're currently constructing.)
     * @return WP_Post[] The array `$elements` but only with the top-level
     *          items. Second-level items are nested under the
     *          `redbrick_children` field of their parent, and similarly for
     *          third-level items, etc.
     * 
     * @see https://wordpress.stackexchange.com/a/196038
     */
    function redbrick_build_array_tree(array &$elements, $parent_id = 0) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->menu_item_parent == $parent_id) {
                $children = redbrick_build_array_tree($elements, $element->ID);
                if ($children) {
                    $element->redbrick_children = $children;
                }
                $branch[$element->ID] = $element;
                unset($element);
            }
        }
        return $branch;
    }
}

if (!function_exists('redbrick_get_nav_menu_items_tree')) {
    /**
     * Get a tree-like array of the items in a given navigation menu. 
     * 
     * @param int|string|WP_Term $menu The ID, slug, or object for the
     *          navigation menu. Such an object can be obtained by the likes of
     *          `wp_get_nav_menu_object()` or
     *          `redbrick_get_nav_menu_object_at_location()`.
     * @return array|null `null` if no such menu exists; else: an array of the
     *          top-level items in the given navigation menu. Each item is an
     *          object as returned by `wp_get_nav_menu_items()`, but also with
     *          a `redbrick_children` field, which is an array of the child
     *          items for that top-level item. In turn, child items have their
     *          own `redbrick_children` field for their children, etc.
     * 
     * @see https://wordpress.stackexchange.com/a/196038
     */
    function redbrick_get_nav_menu_items_tree($menu) {
        $items = wp_get_nav_menu_items($menu);
        return $items ? redbrick_build_array_tree($items) : [] ;
    }
}

if (!function_exists('redbrick_get_html_header_menu_item')) {
    /**
     * Get a fully generated `<li class="[has-submenu] ...">...</li>` item for
     * a given header menu item. This markup is to be used within the
     * `<ul class="menu">...</ul>` element in `header.php`.
     * 
     * @param int $item_id The ID of the menu item (this does not necessarily
     *          equal the ID of the WordPress item it corresponds to,
     *          e.g. if the item is a category, this is not necessarily the
     *          category ID).
     * @param WP_Post $item The menu item.
     * @return string HTML markup for the `<li>` element generated from the
     *          menu item.
     */
    function redbrick_get_html_header_menu_item($item_id, $item) {
        $item_has_children = isset($item->redbrick_children) && (count($item->redbrick_children) != 0);
        $item_slug = '';
        if ($item->object == 'category') {
            $item_slug = get_category($item->object_id)->slug;
        }
        ob_start();
        ?>
        <li class="<?php if ($item_has_children): ?>has-submenu <?php endif; ?>tint section--<?php echo $item_slug; ?>">
            <?php
            /**
             * TODO: HTML `<a>` tag without `href` attribute for items with
             * children exists currently only to result in proper page
             * styling; try and make this unnecessary
             */
            ?>
            <?php if ($item_has_children): ?><a><?php else: ?><a href="<?php echo $item->url; ?>"><?php endif; ?>
                <div class="name-and-arrow-container">
                    <span class="item-<?php echo $item_id; ?>"><?php echo $item->title; ?></span>
                    <?php if ($item_has_children): ?>
                        <span class="submenu-arrow">&gt;</span>
                    <?php endif; ?>
                </div>
            </a>
        </li>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_get_html_header_submenu_from_item')) {
    /**
     * Get a fully generated `<ul class="submenu item-xx">...</ul>` item for a
     * given header menu item. This markup is to be used within the
     * `<div clas="submenu-container">...</div>` element in `header.php`.
     * If the specific header menu item has no children, i.e. does not have a
     * submenu, this function returns an empty string, since no markup is
     * needed for that item.
     * 
     * @param int $item_id The ID of the menu item (this does not necessarily
     *          equal the ID of the WordPress item it corresponds to,
     *          e.g. if the item is a category, this is not necessarily the
     *          category ID).
     * @param WP_Post $item The menu item.
     * @return string HTML markup for the `<ul>` element generated from the
     *          menu item. This elements contains the children of the item
     *          described by `$item`.
     */
    function redbrick_get_html_header_submenu_from_item($item_id, $item) {
        $item_has_children = isset($item->redbrick_children) && (count($item->redbrick_children) != 0);
        if (!$item_has_children) {
            return '';
        }
        ob_start();
        ?>
        <?php
        /**
         * TODO: Background colours for flyouts need to handled, either
         * by using the currently available means of the `<ul>` class
         * `item-xx`, or by some other currently undecided means.
         */

        /**
         * TODO: Incorrect height offset when WordPress admin bar is visible.
         */
        ?>
        <ul class="submenu item-<?php echo $item_id; ?>">
            <li class="back-button">
                <span>&lt; Back</span>
            </li>
            <li><a href="<?php echo $item->url; ?>">
                <span>All <?php echo $item->title; ?></span>
            </a></li>
            <?php foreach ($item->redbrick_children as $subitem_id => $subitem): ?>
                <li><a href="<?php echo $subitem->url; ?>">
                    <span><?php echo $subitem->title; ?></span>
                </a></li>
            <?php endforeach; ?>
        </ul>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_get_html_list_from_menu_tree')) {
    /**
     * Get a fully generated `<ul>...</ul>` item for a given menu tree. Such a
     * tree can be obtained via a call to `redbrick_get_nav_menu_items_tree()`.
     * Submenus will be nested within the `<li>` element corresponding to their
     * parent, as in the HTML5 standard. See the StackOverflow answer given
     * below (https://stackoverflow.com/a/30064576/9996911) for an example of
     * this sort of output.
     * 
     * @see https://stackoverflow.com/a/30064576/9996911
     * 
     * @param WP_Post[] $menu_tree A menu tree, as obtained via a call to
     *      `redbrick_get_nav_menu_items_tree()`. The given array must not be
     *      empty, and it must not be `NULL`, else behaviour is undefined.
     * @return string HTML markup for the generated `<ul>` element.
     */
    function redbrick_get_html_list_from_menu_tree($menu_tree) {
        ob_start();
        ?>
        <ul>
            <?php foreach ($menu_tree as $menu_item_id => $menu_item): ?>
                <li>
                    <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                    </a>
                    <?php
                        if ($menu_item->redbrick_children) {
                            echo redbrick_get_html_list_from_menu_tree($menu_item->redbrick_children);
                        }
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_get_topmost_category_of_post')) {
    /**
     * Get the topmost category of the post with a given ID. By "topmost
     * category", we mean the highest ancestor of the primary category of the
     * post; the result is always a top-level category.
     * 
     * @param int $post_id The ID of the post.
     * @return WP_Term An object populated with data of the topmost category.
     */
    function redbrick_get_topmost_category_of_post($post_id) {
        $primary_category = get_the_category($post_id)[0];
        $ancestors = get_ancestors($primary_category->term_id, 'category');
        return $ancestors ? get_category($ancestors[0]) : $primary_category;
    }
}

if (!function_exists('redrick_get_html_info_box')) {
    /**
     * Get a fully generated `<div class="author-box">...</div>` element for a
     * given post. This element will contain the avatars and names of all
     * authors of the given post (supports "Co-Authors Plus" plugin). If there
     * is only one author, the author's bio will also be present in the markup.
     * 
     * @see https://wordpress.org/plugins/co-authors-plus/
     * 
     * @param int $post_id The ID of the post. Default is the current post
     *      (global `$post` object).
     * @return string HTML markup for the author box element for the given post.
     */
    function redbrick_get_html_author_box($post_id = 0) {
        if (is_plugin_active('co-authors-plus/co-authors-plus.php')) {
            $redbrick_coauthors = get_coauthors($post_id);
        }

        $number_of_authors = $redbrick_coauthors ? count($redbrick_coauthors) : 1;

        if ($number_of_authors == 1) {  // There is only one author
            $author_profile_picture_url = get_avatar_url(get_the_author_meta('ID'));
            $author_has_profile_picture = $author_profile_picture_url !== false;
            $author_name = get_the_author();

            ob_start();
            ?>
            <div class="author-box">
                <?php if ($author_has_profile_picture) : ?>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr($author_name); ?>">
                        <img class="image" src="<?php echo $author_profile_picture_url; ?>" title="<?php echo esc_attr($author_name); ?>"/>
                    </a>
                <?php endif; ?>
                <div class="author-details">
                    <div class="author-name">
                        <?php if (!$author_has_profile_picture): ?>Written by<?php endif; ?>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr($author_name); ?>"><?php echo $author_name; ?></a>
                    </div>
                    <div class="author-bio"><?php the_author_meta('description'); ?></div>
                </div>
            </div>
            <?php
            return ob_get_clean();
        } else if ($number_of_authors <= 4) {
            ob_start();
            ?>
            <div class="author-box">
                <?php foreach ($redbrick_coauthors as $key => $coauthor): ?>
                    <?php
                    $author_profile_picture_url = get_avatar_url($coauthor->ID);
                    $author_has_profile_picture = $author_profile_picture_url !== false;
                    $author_name = get_the_author('display_name', $coauthor->ID);
                    ?>
                    <?php /** TODO: Hyperlink profile picture to author page */ ?>
                    <img class="image" src="<?php echo $author_profile_picture_url; ?>" title="<?php echo esc_attr($author_name); ?>"/>
                <?php endforeach; ?>
                <div class="author-details">
                    <div class="author-name">
                        <?php
                        if ($post_id === 0) {
                            coauthors_posts_links();
                        } else {
                            /** TODO: Implement this */
                            ?>Non-zero post ID!<?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            return ob_get_clean();
        } else {
            ob_start();
            ?>
            <div class="author-box">
                <div class="author-details">
                    <div class="author-name">
                        <?php
                        if ($post_id === 0) {
                            coauthors_posts_links();
                        } else {
                            /** TODO: Implement this; similar to previous if-block implementation */
                            ?>Non-zero post ID!<?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            return ob_get_clean();
        }
    }
}

if (!function_exists('redbrick_get_posts_from_wpp_query')) {
    /**
     * Given the result of a query made using the `WPP_Query` class provided by
     * the "WordPress Popular Posts" plugin, fetch the corresponding post
     * objects (as would be returned by `get_posts`).
     */
    function redbrick_get_posts_from_wpp_query($query) {
        $posts = $query->get_posts();

        if (count($posts) == 0) {
            return [];
        }

        $post_ids = [];
        foreach ($posts as $post) {
            $post_ids[] = (int)($post->id);
        }

        return get_posts( [
            'post__in'  => $post_ids,
            'orderby'  => 'post__in',
        ] );
    }
}

if (!function_exists('redbrick_get_html_photographer_credits')) {
    /**
     * Get a `<div class="photographer-credits">...</div>` element for a post
     * 
     * @param int $post_id The post ID.
     * @return string HTML as described.
     */
    function redbrick_get_html_photographer_credits($post_id) {
        $photographer_names = explode(',', get_post_meta($post_id, 'photographers_name',    true));
        $photographer_urls  = explode(',', get_post_meta($post_id, 'photographers_flickr',  true));
        
        $keys = array_keys($photographer_names);
        $remaining_photographers = count($keys);
        
        ob_start();
        ?>
        <div class="photographer-credits">
            <span class="label">Images by</span>
            <?php while (--$remaining_photographers >= 0) : ?>
                <a href="<?php echo $photographer_urls[$keys[$remaining_photographers]]; ?>"><?php echo $photographer_names[$keys[$remaining_photographers]]; ?></a><?php
                
                if ($remaining_photographers > 1) {
                    echo ',';
                } else if ($remaining_photographers == 1) {
                    echo ' and ';
                }
                ?>
            <?php endwhile; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('redbrick_filter_use_custom_avatar')) {
    /**
     * A hook for the `pre_get_avatar_data` filter that causes
     * `get_avatar_data()` (and thus also `get_avatar_url()`) to return the URL
     * of the custom avatar set via the "Author Image" plugin.
     */
    function redbrick_filter_use_custom_avatar($args, $id_or_email) {
        if ($id_or_email instanceof WP_User) {
            $author_id = $id_or_email->ID;
        } else if ($id_or_email instanceof WP_Post) {
            $author_id = (int)($id_or_email->post_author);
        } else if (is_numeric($id_or_email)) {
            $author_id = (int)$id_or_email;
        } else if ( is_string($id_or_email) && !strpos($id_or_email, '@md5.gravatar.com') ) {
            $user = get_user_by('email', $id_or_email);
            if ($user) {
                $author_id = $user->ID;
            }
        }

        if (isset($author_id)) {
            $avatar_filename = get_user_meta($author_id, 'author_image', true);
            if ( $avatar_filename  &&  $avatar_filename != '(unknown)' ) {
                $args['url'] = '/wp-content/authors/' . $avatar_filename;
            }
        }

        return $args;

    }
}
add_filter('pre_get_avatar_data', 'redbrick_filter_use_custom_avatar', 10, 2);
