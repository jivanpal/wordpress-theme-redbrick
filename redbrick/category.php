<?php get_header(); ?>
<?php
    $category_slug = get_queried_object() -> slug;
?>
<main class="category">
    <div class="showcase-container">    <?php /** This container is used to apply overflow shadows */ ?>
        <ul class="showcase">
            <?php /** TODO: Fetch acutal slider articles */ ?>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/suspiria.jpg"/>
                <div class="tint red"></div>
                <h1 class="title">Cat Art One</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/england.jpg"/>
                <div class="tint orange"></div>
                <h1 class="title">Cat Art Two</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/oldjoe.jpg"/>
                <div class="tint yellow"></div>
                <h1 class="title">Cat Art Three</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/stanlee.jpg"/>
                <div class="tint green"></div>
                <h1 class="title">Cat Art Four</h1>
            </a></li>
            <li class="showcase-item"><a href="#">
                <img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/assets/mockups/capandgown.jpg"/>
                <div class="tint blue"></div>
                <h1 class="title">Cat Art Five</h1>
            </a></li>
        </ul>
    </div>
</main>
<?php get_footer(); ?>
