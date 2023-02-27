<?php   

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles(){   
    //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');  
    //wp_enqueue_script('custom_contact_input', get_stylesheet_directory_uri() . '/assets/js/contact.js', array('jquery'), '1.0.0', true );
    // Ajouter une autre feuille de style (exemple : du css compilé)
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
}

add_action( 'after_setup_theme', 'register_my_menu' );

function register_my_menu() {
  register_nav_menu( 'primary menuu', __( 'Primary Menu', 'primary-menu' ) );
}