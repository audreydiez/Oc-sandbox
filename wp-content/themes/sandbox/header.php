<?php
/**
 * Header file for sandbox child theme .
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage sandbox
 * @since sandbox 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<a class="test" href="<?php echo get_home_url(); ?>">C'est le header</a>
		<?php
		wp_body_open();
		?>

		<nav class="sb-nav">
			<?php
				/* wp_nav_menu( array(
					//'theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu'
					'theme_location' => 'primary',
					'container' => 'ul',
					'menu_class' => 'sb-nav-list',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
					

				) ); */
				wp_nav_menu([
					'theme_location' => 'primary',
					'container' => 'ul',
					'menu_class' => 'sb-nav-list',
					// custom hooks
					'add_li_class'  => 'sb-nav-item',
					'add_a_class' => 'a-link'
				 ])
			?>

		<?= get_search_form() ?>
		</nav>

		<?php
			// Afficher le logo dans le header
			$logo = get_theme_mod( 'header_logo' );
			if ( $logo ) {
			echo '<img src="' . esc_url( $logo ) . '" alt="Header Logo">';
			}
		?>

		<hr>

	
