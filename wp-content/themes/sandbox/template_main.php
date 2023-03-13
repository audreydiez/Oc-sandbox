<?php

/**
 * Template Name: Homepage
 * Template Post Type: page, post
 */

?>

<?php
get_header(); ?>

<div>
    Ceci est mon template "Homepage"
</div>
<br>
<br>
Affichage des taxonomies sport disponibles qui emène vers le template taxonomy-sport.php

<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills my-4">
    <?php foreach ($sports as $sport) : ?>
        <li class="nav-item">
            <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
get_footer(); ?>