<?php 

use OCsandbox\CommentWalker;

/* convertion en int car renvoie une chaine de caractère pour récup le nb de co */
$count = absint(get_comments_number());
?>

<?php if($count > 0) : ?>
    <h2><?php echo $count; ?> Commentaire<?php echo $count > 1 ? 's' : '' ?></h2>
<?php else: ?>
    Pas de commentaires
<?php endif; ?>


<?php if(comments_open()) : ?>
    <?php comment_form(['title_reply' => 'Répondre gentillement']); ?>
<?php endif ?>


<!-- Pour modifier le template, soit recréer toute la fonction comment-template.php, soit faire du hook voir function.php -->
  
<?php wp_list_comments([
    'style' => 'div',
    'walker' => new CommentWalker(),
]); ?>

<?php paginate_comments_links(); ?>