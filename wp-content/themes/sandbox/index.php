<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Sandbox
 * @since Sandbox  1.0
 */

get_header();
?>

<main id="site-content">


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h2><?php the_title(); ?></h2>
                <?php the_content() ?>
                <?php the_post_thumbnail(); ?>

                <?php if (get_post_meta(get_the_ID(), 'sponsoring', true) === '1') : ?>
                    <!--  ou get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) -->
                    <div> Cet article est sponso</div>
                    <?php var_dump(get_post_meta(get_the_ID(), 'sponsoring', true)) ?>
                <?php endif; ?>

                <?php the_terms(get_the_ID(), 'sport', '<br/>Sport: ', ', ') ?>

            </article>
        <?php endwhile;
    else : ?>
        <p>Aucun article :(</p>
    <?php endif; ?>

    <?php

    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'prev_text'    => __('« prev'),
        'next_text'    => __('next »'),
    ));
    ?>


</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer(); ?>