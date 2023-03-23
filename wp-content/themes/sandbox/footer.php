<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage sandbox
 * @since sandbox 1.0
 */

?>

<hr>
<footer id="site-footer" class="header-footer-group">

	footer
	<br>
	Les horaires sont : <?= get_option('agence_horaire') ?>

	<br>
	<br>
	un widget mis dans le footer :
	<br>
	<?php the_widget(YoutubeWidget::class, ['title' => 'Salut', 'youtube' => 'Lj0U4yrYrps']); ?>

</footer><!-- #site-footer -->



</body>

</html>