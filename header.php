<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="site-wrapper">
    <header class="navbar">
            <div class="logo">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Nathalie Mota">
                </a>
            </div>
            <nav class="nav-menu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-menu',
                    'menu_class' => 'header-menu',
                    'container' => false
                ]);
                ?>
                <div class=hamburger>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
    </header>