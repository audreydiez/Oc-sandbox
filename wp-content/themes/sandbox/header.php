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

		<div class="test">header</div>
		<?php
		wp_body_open();
		?>

		<?php
			wp_nav_menu( array(
				//'theme_location' => is_user_logged_in() ? 'logged-in-menu' : 'logged-out-menu'
				'theme_location' => "primary"
			) );
		?>


	
