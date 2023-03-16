<?php get_header() ?>

<h1><?= esc_html(get_queried_object()->name) ?></h1>

<p>
    <?= esc_html(get_queried_object()->description) ?>
</p>
// Affichage des taxo disponibles pour le sport
<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<!-- Si le tableau existe on y va -->
<?php if (is_array($sports)) : ?>
    <ul class="nav nav-pills my-4">
        <?php foreach ($sports as $sport) : ?>
            <li class="nav-item">
                <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

// Si c'est dispo, on affiche
<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <article>
                <h2><?php the_title(); ?></h2>
                <?php the_content() ?>

                <?php if (get_post_meta(get_the_ID(), 'sponsoring', true) === '1') : ?>
                    <!--  ou get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) -->
                    <div> Cet article est sponso</div>
                    <?php var_dump(get_post_meta(get_the_ID(), 'sponsoring', true)) ?>
                <?php endif; ?>

                <?php the_terms(get_the_ID(), 'sport', '<br/>Sport: ', ', ') ?>

            </article>
        <?php endwhile ?>

    </div>

    <?php

    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'prev_text'    => __('« prev'),
        'next_text'    => __('next »'),
    ));
    ?>

<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>