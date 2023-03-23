<?php

class YoutubeWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('youtube_widget', 'Youtube Widget custom', [
            'description' => 'Widget pour afficher une vidéo youtube',
            'classname' => 'youtube-widget'
        ]);
    }

    // args : Arguments passé lors de l'affichage de la sidebar (before widget, after widget...)
    // instance : Récupères les infos du formulaire dans le widget
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (isset($instance['title'])) {
            // permet d'ajouter des comportements en supplément
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';
        echo '<iframe width="300" height="200" src="https://www.youtube.com/embed/' . esc_attr($youtube) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        echo $args['after_widget'];
    }

    // Affichage
    public function form($instance)
    {
        // Voir l'instance en cours pour retrouver les valeurs
        var_dump($instance);
        $title = $instance['title'] ?? 'Ecrire un titre';
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';
?>
        <p>
            <label for="<?= $this->get_field_id('title'); ?>">Titre</label>
            <input type="text" name="<?= $this->get_field_name('title'); ?>" id="<?= $this->get_field_name('title'); ?>" value="<?= esc_attr($title) ?>">
        </p>
        <p>
            <label for="<?= $this->get_field_id('youtube') ?>">Id Youtube</label>
            <input class="widefat" type="text" name="<?= $this->get_field_name('youtube') ?>" value="<?= esc_attr($youtube) ?>" id="<?= $this->get_field_name('youtube') ?>">
        </p>
<?php
    }

    // Mettre à jour les infos dans la bdd
    // $new_instance : Nouvelles valeurs du formulaire
    // $old_instance : Anciennes valeurs du formulaire
    public function update($new_instance, $old_instance)
    {
        //var_dump($new_instance); die();
        return [
            'title' => $new_instance['title'],
            'youtube' => $new_instance['youtube']
        ];
        //ou return $new_instance;
    }
}
