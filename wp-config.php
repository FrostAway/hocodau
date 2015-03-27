<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hocodau_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'Dv.S<G3VP+n/g^okuB|Y)E{E:.W$k7rPM$ ao67>]J[LG@7YmI<s;^v!!dJM_pgq');
define('SECURE_AUTH_KEY',  '|BrQ__C_(s7JUX`&3jRv:+ARI1V{w9X_m9-cX`UW[<4^?n:IH8;%Be3K,~6$^ruZ');
define('LOGGED_IN_KEY',    'ge}|*YMb^KC|wNQIMb&s$2yH /Z=IBU/pgRdz@F&nFj0LMD6#xKc-aPe9+hxL5qs');
define('NONCE_KEY',        'Fe:Z*o?^Vs=4Ed[;dtJ2#rHPvp(6 )1frOvvJs%I& <C>,W7>(=euPqfBoFE&(vN');
define('AUTH_SALT',        '#WmZ&nUY,9zI(w<08>k//>i+}K%.GS3Y/hHS5E)$+#3QF9kKG+ed}%lVY&r$m-~E');
define('SECURE_AUTH_SALT', 'R<+3]-w9Qok01G->Nc]MW!FeXj<DPiY1gU|tY8zx:B#V=gx90/3E5,Mh.uz#?RYG');
define('LOGGED_IN_SALT',   '?x$j[~+*.u{]xlj69u%+cZsPUO()}c-|ZvfDu_B+JxS^&b5x2.|7yno$J4j-%W_-');
define('NONCE_SALT',       't+x6}yEHq_,h(4/1XVz,9Fk(S4rI6R]~MXM4!+a)s+^F3_2]+F29XN~)QkeyXupB');

/**#@-*/
define('WP_ADMIN_DIR', 'hocodau-admin');
define('ADMIN_COOKIE_PATH', SITECOOKIEPATH.WP_ADMIN_DIR);
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
