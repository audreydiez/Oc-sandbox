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

Template  index pour la loop 


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <a href="<?php the_permalink(); ?>">
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                </a>
                <?php the_content() ?>
                <?php the_post_thumbnail(); ?>

                <?php if (get_post_meta(get_the_ID(), 'sponsoring', true) === '1') : ?>
                    <!--  ou get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) -->
                    <div> Cet article est sponso</div>
                    <?php var_dump(get_post_meta(get_the_ID(), 'sponsoring', true)) ?>
                <?php endif; ?>

                <?php the_terms(get_the_ID(), 'sport', '<br/>Sport: ', ', ') ?>

                </br></br>Article liés au tennis : (exemple)
                
                <?php 

                    $query = new WP_Query([
                        'post__not_in' => [get_the_ID()],
                        'post_type' => 'post',
                        'posts_per_page' => 2,
                        'orderby' => 'rand',
                        'tax_query' => [
                        [
                            'taxonomy' => 'sport',
                            'field' => 'slug',
                            'terms' => 'tennis'
                        ]
                        ],
                        'meta_query' => [
                        [
                            'key' => 'sponsoring',
                            'compare' => 'EXISTS'
                        ]
                        ]
                    ]);    
                ?>

                <?php while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="col-sm-4">
                <h3>TROUVé : <?php the_title(); ?></h3>
                    <!-- <?php get_template_part('parts/card', 'post'); ?> -->
                </div>
                <!-- // Reset la boucle -->
                <?php endwhile; wp_reset_postdata(); ?>


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