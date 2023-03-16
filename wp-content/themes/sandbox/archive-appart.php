<?php
get_header();
?>

<main id="site-content">

    <h1>Page archive pour les apparts</h1>


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h2><?php the_title(); ?></h2>
                <?php the_content() ?>
                <?php the_post_thumbnail(); ?>
            </article>
        <?php endwhile;
    else : ?>
        <p>Aucun appartement :(</p>
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