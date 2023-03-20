<?php

class AgenceMenuPage
{

    const GROUP = 'agence_options';

    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
    }

    public static function registerSettings()
    {
        // Nom du groupe, nom de l'option, callback de validation
        register_setting(self::GROUP, 'agence_horaire', ['default' => 'salut']);
        // id de la section, titre, callback, slug de la page
        add_settings_section(
            'agence_horaire_section',
            'Paramètres',
            function () {
                echo "Gestion des paramètres de l'agence";
            },
            self::GROUP
        );
        // id du champ, titre, callback, slug de la page, id de la section
        add_settings_field(
            'agence_horaire',
            "Horaires d'ouverture",
            function () {
?>
            <textarea name="agence_horaire" cols="30" rows="10" style="width: 100%"><?= get_option('agence_horaire') ?></textarea>
        <?php
            },
            self::GROUP,
            'agence_horaire_section'
        );
    }

    public static function addMenu()
    {
        // Titre, permission pour voir la page, slug de la page ( en variable globale), callback pour rendre le contenu, icone, position
        add_menu_page(
            "Gestion de l'agence",
            'Agence',
            'manage_options',
            self::GROUP,
            [self::class, 'render'],
            'dashicons-admin-home',
            3
        );
    }

    public static function render()
    {
        ?>
        <h1>Gestion de l'agence</h1>

        Les horaires sont : <?= get_option('agence_horaire') ?>

        <form action="options.php" method="POST">
            <?php
            // génère les champs cachés pour la sécurité (nonce)
            settings_fields(self::GROUP);
            //affiche les champs de la section
            do_settings_sections(self::GROUP);
            // génère le bouton submit
            submit_button();
            ?>

        </form>

<?php
    }
}
