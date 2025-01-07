<?php
function nmphoto_scripts() {
    wp_enqueue_style('nmphoto-style', get_stylesheet_uri());
    wp_enqueue_script('nmphoto-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'nmphoto_scripts');

function nmphoto_register_menus() {
    register_nav_menus(array(
        'header-menu' => 'Menu Header',
        'footer-menu' => 'Menu Footer'
    ));
}
add_action('init', 'nmphoto_register_menus');
