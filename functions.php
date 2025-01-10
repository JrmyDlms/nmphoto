<?php

// Fonction pour ajouter les types de contenu personnalisés
function nmphoto_scripts() {
    wp_enqueue_style('nmphoto-style', get_stylesheet_uri());
    wp_enqueue_script('nmphoto-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
    wp_enqueue_script('lightbox-js', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), null, true);
    if (is_front_page()) {
        wp_enqueue_script('ajax-photo', get_template_directory_uri() . '/assets/js/ajax-photo.js', array('jquery'), null, true);
        wp_localize_script('ajax-photo', 'monThemeAjax', array(
            'url'   => admin_url('admin-ajax.php'), // URL pour les requêtes AJAX
            'nonce' => wp_create_nonce('ajax_photo_nonce') // Token de sécurité
        ));
    }
}
add_action('wp_enqueue_scripts', 'nmphoto_scripts');

// Fonction pour ajouter les menus
function nmphoto_register_menus() {
    register_nav_menus(array(
        'header-menu' => 'Menu Header',
        'footer-menu' => 'Menu Footer'
    ));
}
add_action('init', 'nmphoto_register_menus');

// Fonction pour charger les photos
function load_more_photos() {
    check_ajax_referer('ajax_photo_nonce', 'nonce');
    
    $page = $_POST['page'];
    $categorie = $_POST['category'];
    $format = $_POST['format'];
    $ordre = $_POST['order'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'orderby' => 'meta_value_num',
        'meta_key' => 'annee',
        'order' => $ordre
    );
    
    if ($categorie || $format) {
        $args['tax_query'] = array();
        
        if ($categorie) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie
            );
        }
        
        if ($format) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format
            );
        }
    }
    
    $photos = new WP_Query($args);

    $reponse = array(
        'success' => true,
        'data' => array(
            'html' => '',
            'hasMore' => false
        )
    );
    
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template_parts/photo', 'block');
        }
        $reponse['data']['html'] = ob_get_clean();
        $reponse['data']['hasMore'] = $photos->max_num_pages > $page;
    }

    wp_send_json($reponse);
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
