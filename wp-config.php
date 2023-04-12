<?php

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'oc_sandbox');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*QuF2p^<a9=59J=v/69[ZdwMCxQYO20BaP-`{(/S#OnVQUBm/E;.pZ xZ8h&+{[Y');
define('SECURE_AUTH_KEY',  'I*{:#.a<$7&y<y9u58EX?3U#5bilEoE[so![3^,JqSyW[rgZ%LU{?VH(*PaCOPdr');
define('LOGGED_IN_KEY',    'BD`%PfkQ._XC;.|T;n*k,Y)fK>=lMzxKy/Vo(X35Z1/5ss@=KBk7wuO4mLh9GvZe');
define('NONCE_KEY',        '-U#Fn<G#)&Ft5T4|ID*`NqXFt`.l:`inyllfVT5uage2kDJR {#sP.>9NIi%&CRO');
define('AUTH_SALT',        'q>ly`QD_68!#dTD^`X|~B#$Ho,def|t9+*1o^fse7_so9`piL10xdAj)%Tvsz@&`');
define('SECURE_AUTH_SALT', '(H}IBRy^czNy+TI8DzLtlc6Sx=2ehFjC|b$UxS%xMrYXh121D,`]sc}J)3FZh_>Y');
define('LOGGED_IN_SALT',   '}sLk*U$i!&:XBJ8E6nfHq+*jV^vvd~Kt>3/cgi|-|sT^J_._-uN./G o*L6pkLS]');
define('NONCE_SALT',       '*r{Z(P8}N<kVJ(`hlQIaOJ_`4LQ!(PdYPR(*.f~?>KCKUpKZP{xIpi%]Q@7b_+$i');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
