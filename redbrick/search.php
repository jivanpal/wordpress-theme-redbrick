<?php get_header(); ?>
<main class="search-results">
    <?php
        global $wp_query;
        $number_of_results = $wp_query->found_posts;
        $html_query_string = esc_html(get_search_query(false));
        $html_attr_query_string = get_search_query();
    ?>
    <div class="constraint-container">
        <h1>Search results</h1>
        <form id="inline-search-form" action="/">
            <input id="inline-search-field" type="search" name="s" placeholder="Search" value="<?php echo $html_attr_query_string; ?>"/>
        </form>
        <?php if (have_posts()) : ?>
            <p>Found <?php echo $number_of_results; ?> results for <i><?php echo $html_query_string; ?></i>.</p>
            <?php if ($number_of_results > 100) : ?>
                <p>Only displaying the first 100 results.</p>
            <?php endif; ?>
            <ul class="post-list">
                <?php
                    while (have_posts()) {
                        the_post();
                        echo redbrick_get_html_post_item(get_post());
                    }
                ?>
            </ul>
        <?php else : ?>
            <p>No results found for <i><?php echo $html_query_string; ?></i>.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
