<?php
get_header();
?>

Ceci est le template single post article

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                
                    <h2>
                        <?php the_title(); ?>
                    </h2>
               
                <?php the_content() ?>
                <?php the_post_thumbnail(); ?>

                <?php if (get_post_meta(get_the_ID(), 'sponsoring', true) === '1') : ?>
                    <!--  ou get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) -->
                    <div> Cet article est sponso</div>
                    <?php var_dump(get_post_meta(get_the_ID(), 'sponsoring', true)) ?>
                <?php endif; ?>

                <?php the_terms(get_the_ID(), 'sport', '<br/>Sport: ', ', ') ?>
            </article>


            <div>Commentaires !</div>
            <!-- Si ouverts et supérieurs à 0 -->
            <?php if(comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>

        <?php endwhile;
    else : ?>
        <p>Aucun article :(</p>
    <?php endif; ?>




    <?php
get_footer(); ?>