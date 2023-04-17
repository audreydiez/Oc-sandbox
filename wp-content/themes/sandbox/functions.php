<?php
/*   var_dump('test');
  error_log("aaaaaaa");
  print_r($args); */

//remove_all_filters('wp_nav_menu_args');

require_once 'walker/commentWalker.php';
/* Pour pouvoir modifier html5_comment dans le walker */
add_theme_support('html5');


function theme_enqueue_styles()
{
  //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');  
  //wp_enqueue_script('custom_contact_input', get_stylesheet_directory_uri() . '/assets/js/contact.js', array('jquery'), '1.0.0', true );
  // Ajouter une autre feuille de style (exemple : du css compilé)
  wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
}

// Ajout des options du customizer
require get_template_directory() .'/customizer/header-logo.php';

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
  $value = get_post_meta($post->ID, 'sponsoring', true);
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

// Add option in admin menu
require_once('options/agence.php');
AgenceMenuPage::register();

// ajouter des colonnes supplémentaires dans le listing des articles
add_filter('manage_post_posts_columns', function ($columns) {
  $newColumns = [];
  foreach ($columns as $k => $v) {
    if ($k === 'date') {
      $newColumns['sponso'] = 'Article sponsorisé ?';
    }
    $newColumns[$k] = $v;
  }
  return $newColumns;
});
add_filter('manage_post_posts_custom_column', function ($column, $postId) {
  // var_dump(get_post_meta($postId, 'sponsoring'));
  //var_dump($column);
  if ($column === 'sponso') {
    if (!empty(get_post_meta($postId, 'sponsoring'))) {
      $value = 'oui';
    } else {
      $value = 'non';
    }
    echo '<div class="bullet bullet-">' . $value . '</div>';
  }
}, 10, 2);



// Sidebar
require_once('widgets/YoutubeWidget.php');

function add_home_sidebar()
{
  /// Ajouter un widget

  register_widget(YoutubeWidget::class);

  register_sidebar([
    'name' => 'Sidebar home',
    'id' => 'home-sidebar',
    'description' => 'La sidebar de la page home',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ]);
}

add_action('widgets_init', 'add_home_sidebar');

// _____________________________________________________________________________________________________
// ajouter la colonne à la liste des colonnes gràce au filtre manage_{$post_type}_posts_columns

add_filter('manage_appart_posts_columns', function ($columns) {
  return  [
    'cb' => $columns['cb'],
    'thumbnail' => 'miniature',
    'title' => $columns['title'],
    'date' => $columns['date'],
  ];
});

add_filter('manage_appart_posts_custom_column', function ($column, $postId) {
  if ($column === 'thumbnail') {
    the_post_thumbnail('thumbnail', $postId, ['class' => 'img-fluid']);
  }
}, 10, 2);

// _____________________________________________________________________________________________________
// ajouter la colonne is sponso ? aux articles

add_filter('manage_post_posts_columns', function ($columns) {
  $newColumns = [];
  foreach($columns as $key => $value) {
      if ($key === 'date') {
          $newColumns['sponso'] = 'Article sponsorisé ?';
      }
      // Réassignement des colonnes
      $newColumns[$key] = $value;
  }
  return $newColumns;
});
// Ajouter le contenu de la colonne
add_filter('manage_post_posts_custom_column', function ($column, $postId) {
  if ($column === 'sponso') {
      if (!empty(get_post_meta($postId, 'sponsoring', true))) {
          $class = 'yes';
      } else {
          $class = 'no';
      }
      echo '<div class="bullet bullet-' . $class . '"></div>';
  }
}, 10, 2);


/* Modification des commentaires */
add_filter('comment_form_default_fields', function ($fields) {
   $fields['author'] = '<div class="form-group"><label for="author!">Nom</label><input type="text" class="form-control" id="author" name="author" value="" required></div>';
  $fields['email'] = '<div class="form-group"><label for="email">Email!</label><input type="email" class="form-control" id="email" name="email" value="" required></div>';
  $fields['url'] = '<div class="form-group"><label for="url">Site web!</label><input type="url" class="form-control" id="url" name="url" value=""></div>';
  /* var_dump($fields); */
  return $fields;
});
add_filter('comment_form_defaults', function ($fields) {
  $fields['comment_field'] = '<div class="form-group"><label for="comment">Commentaire</label><textarea class="form-control" id="comment" name="comment" rows="3" required></textarea></div>';
  $fields['class_submit'] = 'btn btn-primary';
  /* var_dump($fields);   */
  return $fields;  
});

