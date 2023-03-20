<?php
/*   var_dump('test');
  error_log("aaaaaaa");
  print_r($args); */

//remove_all_filters('wp_nav_menu_args');

function theme_enqueue_styles()
{
  //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');  
  //wp_enqueue_script('custom_contact_input', get_stylesheet_directory_uri() . '/assets/js/contact.js', array('jquery'), '1.0.0', true );
  // Ajouter une autre feuille de style (exemple : du css compilé)
  wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
}

function register_my_menu()
{
  register_nav_menu('primary', 'Menu principal haut');
}



// Voir les arguments passés dans wp nav menu
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


function add_additional_class_on_li($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes[] = $args->add_li_class;
  }
  return $classes;
}

function menu_link_add_class($atts, $item, $args)
{

  if (isset($args->add_a_class)) {
    $atts['class'] = $args->add_a_class;
  }
  return $atts;
}

function active_class_menu($classes, $item)
{
  if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

// Metadonnées -----------------------------------------------------------------------------------------------
// id, name, callback function, type of page applying
function add_custom_metabox()
{
  add_meta_box('sponsoring', 'Sponsoring', 'render_sponso_box', 'post');
};

function render_sponso_box()
{
  global $post;
  $value = get_post_meta($post->ID, 'coucou_checkbox', true);
  $checked = ($value == '1') ? 'checked' : '';
?>
  <input type="checkbox" value="1" name="sponsoring" <?php echo $checked; ?>>
  <label for="sponsoring">Cet article est sponsorisé ?</label>
<?php
}

function save_sponso_box($post_id)
{
  //if (array_key_exists('sponsoring', $_POST)) 
  if (isset($_POST['sponsoring'])) {
    //var_dump($_POST);
    //die();
    update_post_meta(
      $post_id,
      'sponsoring',
      '1'
    );
  } else {
    delete_post_meta(
      $post_id,
      'sponsoring'
    );
  }
}

// Metadonnées -----------------------------------------------------------------------------------------------

// taxonomies
function register_sport()
{
  register_taxonomy('sport', 'post', [
    'labels' => [
      'name' => 'Sport',
      'singular_name'     => 'Sport',
      'plural_name'       => 'Sports',
      'search_items'      => 'Rechercher des sports',
      'all_items'         => 'Tous les sports',
      'edit_item'         => 'Editer le sport',
      'update_item'       => 'Mettre à jour le sport',
      'add_new_item'      => 'Ajouter un nouveau sport',
      'new_item_name'     => 'Ajouter un nouveau sport',
      'menu_name'         => 'Sport',
    ],
    'show_in_rest' => true,
    'hierarchical' => true,
    'show_admin_column' => true,
  ]);
}

function custom_post_types()
{
  register_post_type('appart', [
    'label' => 'Appart',
    'public' => true,
    'menu_position' => 3,
    'menu_icon' => 'dashicons-building',
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    'show_in_rest' => true,
    'has_archive' => true,
  ]);
}



add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('after_setup_theme', 'register_my_menu');
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter('nav_menu_link_attributes', 'menu_link_add_class', 10, 3);
add_filter('nav_menu_css_class', 'active_class_menu', 10, 2);
// Ajouter une métaboxe
add_action('add_meta_boxes', 'add_custom_metabox');
add_action('save_post', 'save_sponso_box');

add_action('init', 'register_sport');

// Custom posts types
add_theme_support('post-thumbnails');
add_action('init', 'custom_post_types');

//require_once('metaboxes/sponsoring.php');
//SponsoMetaBox::register(); 

require_once('options/agence.php');
AgenceMenuPage::register();
