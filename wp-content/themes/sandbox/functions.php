<?php   
/*   var_dump('test');
  error_log("aaaaaaa");
  print_r($args); */

  remove_all_filters( 'wp_nav_menu_args' );

function theme_enqueue_styles(){   
    //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');  
    //wp_enqueue_script('custom_contact_input', get_stylesheet_directory_uri() . '/assets/js/contact.js', array('jquery'), '1.0.0', true );
    // Ajouter une autre feuille de style (exemple : du css compilé)
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
}

function register_my_menu() {
  register_nav_menu('primary', 'Menu principal haut');
}




/*  add_filter( 'pre_wp_nav_menu', 'smyles_dump_nav_menu_args', 9999, 2 );

function smyles_dump_nav_menu_args( $null, $args ){
    ob_start();

    echo '<pre>';
    var_dump($args);
    echo '</pre>';

    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}  */


function add_additional_class_on_li($classes, $item, $args) {
  if(isset($args->add_li_class)) {
      $classes[] = $args->add_li_class;
  }
  return $classes;
}



function menu_link_add_class( $atts, $item, $args ) {

  if(isset($args->add_a_class)) {
    $atts['class'] = $args->add_a_class;
  }
  return $atts;
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action( 'after_setup_theme', 'register_my_menu' );
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter( 'nav_menu_link_attributes', 'menu_link_add_class', 10, 3 );


