<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div class="hamburger">
                <?php echo file_get_contents(get_template_directory() . '/assets/hamburger.svg'); ?>
            </div>
            <a href="/">
                <div class="logo">
                    <div class="icon">
                        <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-icon.svg'); ?>
                    </div>
                    <div class="wordmark">
                        <?php echo file_get_contents(get_template_directory() . '/assets/redbrick-wordmark.svg'); ?>
                    </div>
                </div>
            </a>
            <div class="search">
                <?php echo file_get_contents(get_template_directory() . '/assets/search.svg'); ?>
            </div>
        </header>
