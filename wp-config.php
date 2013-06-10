<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// define('DB_NAME', 'site');
define('DB_NAME', 'db name goes here');


/** MySQL database username */
define('DB_USER', 'db user goes here');

/** MySQL database password */
define('DB_PASSWORD', 'db passwd goes here');

/** MySQL hostname */
define('DB_HOST', 'db host goes here');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Im gonna pop some tags Only got twenty dollars in my pocket');
define('SECURE_AUTH_KEY',  'Ima take your grandpas style, Ima take your grandpas style');
define('LOGGED_IN_KEY',    'Ill take those flannel zebra jammies, second-hand, I rock that');
define('NONCE_KEY',        'I see a red door and I want it painted black ');
define('AUTH_SALT',        'No colors anymore I want them to turn black ');
define('SECURE_AUTH_SALT', 'I see the girls walk by dressed in their summer clothes ');
define('LOGGED_IN_SALT',   'I have to turn my head until my darkness goes ');
define('NONCE_SALT',       'No more will my green sea go turn a deeper blue I could not forsee this thing happening to you');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

define('WP_CONTENT_DIR', realpath(__DIR__ . '/wp-content'));
define('WP_PLUGIN_DIR', realpath(__DIR__ . '/wp-content/plugins'));
define('PLUGINDIR', realpath(__DIR__ . '/wp-content/plugins'));
define('WP_SITEURL', 'http://blog.frontburnr.local');
define('WP_HOME', 'http://blog.frontburnr.local');
define('WP_CONTENT_URL', 'http://blog.frontburnr.local/wp-content');
define('WP_PLUGIN_URL', 'http://blog.frontburnr.local/wp-content/plugins');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
